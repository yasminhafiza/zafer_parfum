<?php
$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
?>

<div class="container">
    <div class="shadow p-3 mb-3 rounded bg-white text-center shadow-custom">
        <h4>Update Password</h4>
    </div>

    <div class="shadow p-4 rounded bg-white shadow-custom">
        <form method="post">
            <div class="form-group row">
                <label for="pass_lama" class="col-sm-3 col-form-label">Password Lama :</label>
                <div class="col-sm-9">
                    <input type="password" id="pass_lama" name="pass_lama" class="form-control" placeholder="masukkan password lama anda">
                </div>
            </div>

            <div class="form-group row">
                <label for="pass_baru" class="col-sm-3 col-form-label">Password Baru :</label>
                <div class="col-sm-9">
                    <input type="password" id="pass_baru" name="pass_baru" class="form-control" placeholder="masukkan password baru anda">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-9 offset-sm-3">
                    <input type="checkbox" id="show_password" onclick="togglePassword()"> Show Password
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-9 offset-sm-3">
                    <button type="submit" name="update" class="btn btn-success">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function togglePassword() {
    var passLama = document.getElementById("pass_lama");
    var passBaru = document.getElementById("pass_baru");
    if (passLama.type === "password") {
        passLama.type = "text";
        passBaru.type = "text";
    } else {
        passLama.type = "password";
        passBaru.type = "password";
    }
}
</script>

<?php
if (isset($_POST['update'])) {
    $pass_lama = sha1($_POST['pass_lama']);
    $pass_baru = sha1($_POST['pass_baru']);

    $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE password_pelanggan='$pass_lama' AND id_pelanggan='$id_pelanggan'");
    $pass = $ambil->num_rows;
    if ($pass == 1) {
        $koneksi->query("UPDATE pelanggan SET password_pelanggan='$pass_baru' WHERE id_pelanggan='$id_pelanggan'");
        echo "<script>alert('Password berhasil diubah');</script>";
        echo "<script>location='../login.php';</script>";
    } else {
        echo "<script>alert('Password gagal diubah');</script>";
        echo "<script>location='index.php?page=update_password';</script>";
    }
}
?>
