<?php
// File untuk menyimpan data
$dataFile = 'employee_data.json';

// Fungsi untuk membaca data dari file
function readEmployeeData($file) {
    if (file_exists($file)) {
        $data = file_get_contents($file);
        return json_decode($data, true) ?: [];
    }
    return [];
}

// Fungsi untuk menyimpan data ke file
function saveEmployeeData($file, $data) {
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
}

// Fungsi untuk generate ID
function generateId($employees) {
    return count($employees) + 1;
}

// Inisialisasi data
$employees = readEmployeeData($dataFile);
$message = '';
$editData = null;

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? 'add';
    
    $uploadedFileName = '';
    if (isset($_FILES['file_upload']) && $_FILES['file_upload']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $originalName = basename($_FILES['file_upload']['name']);
        $uniqueName = time() . '_' . preg_replace('/[^a-zA-Z0-9_\.-]/', '_', $originalName);
        $targetPath = $uploadDir . $uniqueName;
        if (move_uploaded_file($_FILES['file_upload']['tmp_name'], $targetPath)) {
            $uploadedFileName = $uniqueName;
        }
    } elseif ($action === 'edit') {
        // Jika edit dan tidak upload file baru, gunakan file lama
        $uploadedFileName = $_POST['file_upload_old'] ?? '';
    }

    if ($action === 'add' || $action === 'edit') {
        $employee = [
            'id' => $action === 'edit' ? (int)$_POST['id'] : generateId($employees),
            'employee_id' => $_POST['employee_id'] ?? '',
            'name' => $_POST['name'] ?? '',
            'email' => $_POST['email'] ?? '',
            'phone' => $_POST['phone'] ?? '',
            'gender' => $_POST['gender'] ?? '',
            'address' => $_POST['address'] ?? '',
            'join_date' => $_POST['join_date'] ?? '',
            'department' => $_POST['department'] ?? '',
            'division' => $_POST['division'] ?? '',
            'status' => $_POST['status'] ?? '',
            'asuransi' => $_POST['asuransi'] ?? [],
            'file_upload' => $uploadedFileName
        ];
        
        if ($action === 'edit') {
            $index = array_search((int)$_POST['id'], array_column($employees, 'id'));
            if ($index !== false) {
                $employees[$index] = $employee;
                $message = 'Data berhasil diperbarui!';
            }
        } else {
            $employees[] = $employee;
            $message = 'Data berhasil ditambahkan!';
        }
        
        saveEmployeeData($dataFile, $employees);
    }
    
    if ($action === 'delete') {
        $id = (int)$_POST['id'];
        $employees = array_filter($employees, function($emp) use ($id) {
            return $emp['id'] !== $id;
        });
        $employees = array_values($employees); // Reindex array
        saveEmployeeData($dataFile, $employees);
        $message = 'Data berhasil dihapus!';
    }
}

// Handle edit request
if (isset($_GET['edit'])) {
    $editId = (int)$_GET['edit'];
    $editData = array_filter($employees, function($emp) use ($editId) {
        return $emp['id'] === $editId;
    });
    $editData = reset($editData);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Data</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: "Montserrat", regular, sans-serif;
            font-size: 14px;
            margin: 0;
            padding: 0;
        }
        
        body {
            background: radial-gradient(circle, #754c2d 0%, #f7e3b3 90%);
            min-height: 100vh;
            padding: 20px;
            box-sizing: border-box;
        }

        p {
            font-size: 1.1rem;
            color: #ffffff;
        }

        .title {
            text-align: center;
            margin-bottom: 2rem;
        }

        .title h2 {
            font-size: 2.5rem;
            color: #754c2d;
            font-weight: 800;
        }

        .message {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
            text-align: center;
        }

        .main-container {
            display: flex;
            gap: 20px;
            max-width: 1400px;
            margin: 0 auto;
            align-items: flex-start;
        }
        
        .form-container {
            flex: 1;
            min-width: 350px;
        }

        .table-container {
            flex: 2;
            min-width: 600px;
        }
        
        .form {
            background-color: #e1b07a;
            padding: 2rem;
            border: 1px solid #ffffffc7;
            border-radius: 10px;
            box-shadow: 10px 15px 7px rgba(0, 0, 0, 0.233);
            height: fit-content;
        }
        
        .form form {
            width: 100%;
            display: flex;
            flex-direction: column;
        }
        
        .form label {
            font-weight: bold;
            color: #754c2d;
            display: block;
            margin-bottom: 5px;
            text-align: left;
        }

        .form label[for="status"],
        .form .asuransi-label {
            font-weight: bold;
            color: #754c2d;
            margin-bottom: 10px;
            font-size: medium;
            font-weight: 800;            
        }

        .form input[type="text"],
        .form input[type="email"],
        .form input[type="tel"],
        .form input[type="date"],
        .form select,
        .form textarea,
        .form input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #754c2d;
            border-radius: 8px;
            box-sizing: border-box;
            text-align: left;
            background: #fff;
            margin-bottom: 15px;
        }
        
        .form textarea {
            resize: vertical;
        }
        
        .form input[type="radio"],
        .form input[type="checkbox"] {
            margin-right: 8px;
            cursor: pointer;
        }

        .status, .asuransi {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
        }

        .status div, .asuransi div {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }
        
        .form input[type="submit"],
        .form input[type="reset"],
        .form .btn-cancel {
            background-color: #754c2d;
            font-weight: bold;
            width: 100%;
            color: #F5F4F3;
            margin-top: 10px;
            padding: 10px 0;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            transition: background 0.2s;
            text-decoration: none;
            text-align: center;
            display: inline-block;
        }
        
        .form input[type="submit"]:hover,
        .form input[type="reset"]:hover,
        .form .btn-cancel:hover {
            background-color: #2b1c10;
        }

        .btn-cancel {
            background-color: #6c757d !important;
            margin-top: 5px !important;
        }

        .btn-cancel:hover {
            background-color: #5a6268 !important;
        }

        .data-table {
            background-color: #e1b07a;
            padding: 2rem;
            border: 1px solid #ffffffc7;
            border-radius: 10px;
            box-shadow: 10px 15px 7px rgba(0, 0, 0, 0.233);
            height: fit-content;
        }

        .data-table h3 {
            color: #754c2d;
            font-size: 1.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            text-align: center;
        }

        .table-wrapper {
            overflow-x: auto;
            max-height: 500px;
            overflow-y: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            font-size: 13px;
        }

        th {
            background-color: #754c2d;
            color: white;
            font-weight: bold;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .no-data {
            text-align: center;
            color: #754c2d;
            font-style: italic;
            padding: 2rem;
        }

        .action-buttons {
            display: flex;
            gap: 5px;
        }

        .btn-edit, .btn-delete {
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
            transition: background 0.2s;
            text-decoration: none;
            color: white;
        }

        .btn-edit {
            background-color: #28a745;
        }

        .btn-edit:hover {
            background-color: #218838;
        }

        .btn-delete {
            background-color: #dc3545;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }

        footer {
            position: fixed;
            padding: 20px;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 14px;
            background-color: #754c2d;
        }
        
        @media (max-width: 1200px) {
            .main-container {
                flex-direction: column;
            }
            
            .form-container, .table-container {
                min-width: 100%;
            }
        }

        @media (max-width: 768px) {
            body {
                padding: 10px;
            }
            
            .form, .data-table {
                padding: 1rem;
            }
            
            .title h2 {
                font-size: 1.8rem;
            }
            
            table {
                font-size: 11px;
            }
            
            th, td {
                padding: 8px;
            }
        }
    </style>
</head>
<body>
    <div class="title">
        <h2>Employee Data Input</h2>
    </div>

    <?php if ($message): ?>
        <div class="message"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>

    <div class="main-container">
        <div class="form-container">
            <div class="form">
                <form method="post" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="<?php echo $editData ? 'edit' : 'add'; ?>">
                    <?php if ($editData): ?>
                        <input type="hidden" name="id" value="<?php echo $editData['id']; ?>">
                    <?php endif; ?>

                    <label for="employee_id">UID</label>
                    <input type="text" id="employee_id" name="employee_id" value="<?php echo htmlspecialchars($editData['employee_id'] ?? ''); ?>" required>

                    <label for="name">Nama</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($editData['name'] ?? ''); ?>" required>

                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($editData['email'] ?? ''); ?>" required>

                    <label for="phone">No. Telepon</label>
                    <input type="tel" id="phone" name="phone" pattern="[0-9]{10,15}" placeholder="+62 812 3456 789" value="<?php echo htmlspecialchars($editData['phone'] ?? ''); ?>" required>

                    <label for="gender">Jenis Kelamin</label>
                    <select id="gender" name="gender" required>
                        <option value="">--Pilih--</option>
                        <option value="Laki-laki" <?php echo ($editData['gender'] ?? '') === 'Laki-laki' ? 'selected' : ''; ?>>Laki-laki</option>
                        <option value="Perempuan" <?php echo ($editData['gender'] ?? '') === 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>
                    </select>

                    <label for="address">Alamat</label>
                    <textarea id="address" name="address" rows="3" cols="30"><?php echo htmlspecialchars($editData['address'] ?? ''); ?></textarea>

                    <label for="join_date">Tanggal Bergabung</label>
                    <input type="date" id="join_date" name="join_date" value="<?php echo htmlspecialchars($editData['join_date'] ?? ''); ?>" required>

                    <label for="department">Department</label>
                    <select id="department" name="department">
                        <option value="HR" <?php echo ($editData['department'] ?? '') === 'HR' ? 'selected' : ''; ?>>HR</option>
                        <option value="Creative" <?php echo ($editData['department'] ?? '') === 'Creative' ? 'selected' : ''; ?>>Creative</option>
                        <option value="IT" <?php echo ($editData['department'] ?? '') === 'IT' ? 'selected' : ''; ?>>IT</option>
                        <option value="Finance" <?php echo ($editData['department'] ?? '') === 'Finance' ? 'selected' : ''; ?>>Finance</option>
                        <option value="Marketing" <?php echo ($editData['department'] ?? '') === 'Marketing' ? 'selected' : ''; ?>>Marketing</option>
                    </select>

                    <label for="division">Divisi</label>
                    <select id="division" name="division" required>
                        <option value="">--Pilih Divisi--</option>
                        <option value="Desain Grafis" <?php echo ($editData['division'] ?? '') === 'Desain Grafis' ? 'selected' : ''; ?>>Desain Grafis</option>
                        <option value="Operasional" <?php echo ($editData['division'] ?? '') === 'Operasional' ? 'selected' : ''; ?>>Operasional</option>
                        <option value="Pengembangan Produk" <?php echo ($editData['division'] ?? '') === 'Pengembangan Produk' ? 'selected' : ''; ?>>Pengembangan Produk</option>
                        <option value="Penjualan" <?php echo ($editData['division'] ?? '') === 'Penjualan' ? 'selected' : ''; ?>>Penjualan</option>
                        <option value="Customer Service" <?php echo ($editData['division'] ?? '') === 'Customer Service' ? 'selected' : ''; ?>>Customer Service</option>
                    </select>

                    <div class="status">
                        <label for="status">Status Karyawan</label>
                        <div>
                            <input type="radio" id="tetap" name="status" value="Tetap" <?php echo ($editData['status'] ?? '') === 'Tetap' ? 'checked' : ''; ?> required> 
                            <label for="tetap">Tetap</label>
                        </div>
                        <div>
                            <input type="radio" id="kontrak" name="status" value="Kontrak" <?php echo ($editData['status'] ?? '') === 'Kontrak' ? 'checked' : ''; ?>> 
                            <label for="kontrak">Kontrak</label>
                        </div>
                    </div>

                    <div class="asuransi">
                        <label class="asuransi-label">Asuransi</label>
                        <div>
                            <input type="checkbox" id="bpjs_tk" name="asuransi[]" value="BPJS Tenaga Kerja" <?php echo in_array('BPJS Tenaga Kerja', $editData['asuransi'] ?? []) ? 'checked' : ''; ?>> 
                            <label for="bpjs_tk">BPJS Tenaga Kerja</label>
                        </div>
                        <div>
                            <input type="checkbox" id="bpjs_kes" name="asuransi[]" value="BPJS Kesehatan" <?php echo in_array('BPJS Kesehatan', $editData['asuransi'] ?? []) ? 'checked' : ''; ?>> 
                            <label for="bpjs_kes">BPJS Kesehatan</label>
                        </div>
                    </div>

                    <label for="file_upload">Upload File</label>
                    <input type="file" id="file_upload" name="file_upload">
                    <?php if ($editData && !empty($editData['file_upload'])): ?>
                        <input type="hidden" name="file_upload_old" value="<?php echo htmlspecialchars($editData['file_upload']); ?>">
                    <?php endif; ?>

                    <input type="submit" value="<?php echo $editData ? 'Update' : 'Submit'; ?>">
                    <input type="reset" value="Reset">
                    
                    <?php if ($editData): ?>
                        <a href="?" class="btn-cancel">Cancel</a>
                    <?php endif; ?>
                </form>
            </div>
        </div>

        <div class="table-container">
            <div class="data-table">
            <h3>Data Karyawan</h3>
            <div class="table-wrapper">
                <table>
                <thead>
                    <tr>
                    <th>No</th>
                    <th>UID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Gender</th>
                    <th>Alamat</th>
                    <th>Tgl Bergabung</th>
                    <th>Department</th>
                    <th>Divisi</th>
                    <th>Status</th>
                    <th>Asuransi</th>
                    <th>File</th>
                    <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($employees)): ?>
                    <tr>
                        <td colspan="14" class="no-data">Belum ada data karyawan</td>
                    </tr>
                    <?php else: ?>
                    <?php foreach ($employees as $index => $employee): ?>
                        <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo htmlspecialchars($employee['employee_id'] ?? '-'); ?></td>
                        <td><?php echo htmlspecialchars($employee['name'] ?? '-'); ?></td>
                        <td><?php echo htmlspecialchars($employee['email'] ?? '-'); ?></td>
                        <td><?php echo htmlspecialchars($employee['phone'] ?? '-'); ?></td>
                        <td><?php echo htmlspecialchars($employee['gender'] ?? '-'); ?></td>
                        <td><?php echo htmlspecialchars($employee['address'] ?? '-'); ?></td>
                        <td><?php echo htmlspecialchars($employee['join_date'] ?? '-'); ?></td>
                        <td><?php echo htmlspecialchars($employee['department'] ?? '-'); ?></td>
                        <td><?php echo htmlspecialchars($employee['division'] ?? '-'); ?></td>
                        <td><?php echo htmlspecialchars($employee['status'] ?? '-'); ?></td>
                        <td><?php echo htmlspecialchars(is_array($employee['asuransi']) ? implode(', ', $employee['asuransi']) : ($employee['asuransi'] ?? '-')); ?></td>
                        <td>
                            <?php
                            if (!empty($employee['file_upload'])) {
                            $filePath = 'uploads/' . basename($employee['file_upload']);
                            echo '<a href="' . htmlspecialchars($filePath) . '" target="_blank">Lihat File</a>';
                            } else {
                            echo '-';
                            }
                            ?>
                        </td>
                        <td class="action-buttons">
                            <a href="?edit=<?php echo $employee['id']; ?>" class="btn-edit">Edit</a>
                            <form method="post" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id" value="<?php echo $employee['id']; ?>">
                            <button type="submit" class="btn-delete">Delete</button>
                            </form>
                        </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>

    <footer>
        <p>© THEGODCOD 2025 - Fundamental Web. All rights reserved.</p>
    </footer>

    <script>
        // Auto-hide message after 3 seconds
        setTimeout(function() {
            var message = document.querySelector('.message');
            if (message) {
                message.style.display = 'none';
            }
        }, 3000);
    </script>
</body>
</html> 