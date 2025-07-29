<!DOCTYPE html>
<html>

<head>
    <title>Tambah User</title>
</head>

<body>
    <h1>Tambah User</h1>

    <form action="/admin/users" method="POST">
        @csrf
        <label>Nama:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Role:</label><br>
        <select name="role" required>
            <option value="admin">Admin</option>
            <option value="user">user</option>
        </select><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Simpan</button>
    </form>
</body>

</html>
