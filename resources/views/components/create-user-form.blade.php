<!-- create-user-form.blade.php -->

    <div class="mb-3">
        <label class="form-label">Nama depan</label>
        <input type="text" id="first_name" name="first_name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Nama belakang</label>
        <input type="text" id="last_name" name="last_name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" id="username" name="username" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" id="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Alamat</label>
        <input type="text" id="address" name="address" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">No Hp</label>
        <input type="text" id="phone" name="phone" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" id="password" name="password" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Role</label>
        <select class="form-select" id="role" name="role">
            <option value="admin">Admin</option>
            <option value="pegawai">Pegawai</option>
            <option value="dokter">Dokter</option>
            <option value="apoteker">Apoteker</option>
        </select>
    </div>


