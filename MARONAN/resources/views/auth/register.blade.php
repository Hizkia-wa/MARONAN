<!DOCTYPE html>
<html>
<head>
    <title>Register Petani - MARONAN</title>
</head>
<body>

<h2>Registrasi Petani MARONAN</h2>

@if($errors->any())
    <ul style="color:red;">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form method="POST" action="/register" enctype="multipart/form-data">
    @csrf

    <input type="text" name="name" placeholder="Nama Lengkap" required><br><br>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="text" name="phone" placeholder="Nomor WhatsApp" required><br><br>

    <input type="password" name="password" placeholder="Password" required><br><br>
    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required><br><br>

    <textarea name="address" placeholder="Alamat Rumah" required></textarea><br><br>
    <input type="text" name="village" placeholder="Desa" required><br><br>

    <input type="text" name="farmer_id_number" placeholder="Nomor KTP" required><br><br>
    <textarea name="farm_address" placeholder="Alamat Lahan" required></textarea><br><br>
    <input type="text" name="land_area" placeholder="Luas Lahan" required><br><br>
    <input type="text" name="main_commodity" placeholder="Komoditas Utama" required><br><br>

    <textarea name="commitment_statement" placeholder="Pernyataan Komitmen" required></textarea><br><br>

    <label>Upload Bukti (Foto Lahan / Surat)</label><br>
    <input type="file" name="supporting_document" required><br><br>

    <button type="submit">Daftar</button>
</form>

</body>
</html>