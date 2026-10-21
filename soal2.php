<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menghitung Total Belanja</title>
</head>
<body>
    <h2>Aplikasi Hitung Total Belanja</h2>

    <form method="post">
        <h3>Daftar Menu / Produk Tersedia:</h3>
        <ul>
            <li>Buku Tulis - Rp 5.000</li>
            <li>Pena - Rp 3.000</li>
            <li>Penghapus - Rp 2.000</li>
            <li>Penggaris - Rp 4.000</li>
        </ul>

        <label>Jumlah Buku Tulis:</label>
        <input type="number" name="qty_buku" value="0" min="0"><br><br>

        <label>Jumlah Pena:</label>
        <input type="number" name="qty_pena" value="0" min="0"><br><br>

        <label>Jumlah Penghapus:</label>
        <input type="number" name="qty_penghapus" value="0" min="0"><br><br>

        <label>Jumlah Penggaris:</label>
        <input type="number" name="qty_penggaris" value="0" min="0"><br><br>

        <button type="submit" name="hitung_belanja">Hitung Total</button>
    </form>

    <br>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['hitung_belanja'])) {
        
        $daftar_harga = [
            "Buku Tulis" => 5000,
            "Pena"       => 3000,
            "Penghapus"  => 2000,
            "Penggaris"  => 4000
        ];

        $jumlah_beli = [
            "Buku Tulis" => (int)$_POST['qty_buku'],
            "Pena"       => (int)$_POST['qty_pena'],
            "Penghapus"  => (int)$_POST['qty_penghapus'],
            "Penggaris"  => (int)$_POST['qty_penggaris']
        ];

        $total_kotor = 0;

        echo "<h3>Struk Rincian Belanja:</h3>";
        echo "<table border='1' cellpadding='5' cellspacing='0'>";
        echo "<tr><th>Nama Barang</th><th>Harga Satuan</th><th>Jumlah</th><th>Subtotal</th></tr>";

        foreach ($daftar_harga as $barang => $harga) {
            $qty = $jumlah_beli[$barang];
            
            if ($qty > 0) {
                $subtotal = $harga * $qty;
                $total_kotor += $subtotal;
                
                echo "<tr>";
                echo "<td>$barang</td>";
                echo "<td>Rp " . number_format($harga, 0, ',', '.') . "</td>";
                echo "<td>$qty</td>";
                echo "<td>Rp " . number_format($subtotal, 0, ',', '.') . "</td>";
                echo "</tr>";
            }
        }
        echo "</table><br>";

        $diskon = 0;
        if ($total_kotor >= 50000) {
            $diskon = 0.10 * $total_kotor; 
            $keterangan_diskon = "Mendapat Diskon 10% (Belanja >= Rp 50.000)";
        } else {
            $diskon = 0;
            $keterangan_diskon = "Tidak Mendapat Diskon (Belanja di bawah Rp 50.000)";
        }

        $total_akhir = $total_kotor - $diskon;

        echo "<strong>Total Belanja Awal:</strong> Rp " . number_format($total_kotor, 0, ',', '.') . "<br>";
        echo "<strong>Diskon:</strong> Rp " . number_format($diskon, 0, ',', '.') . " ($keterangan_diskon)<br>";
        echo "<h3>Total yang Harus Dibayar: Rp " . number_format($total_akhir, 0, ',', '.') . "</h3>";
    }
    ?>
</body>
</html>