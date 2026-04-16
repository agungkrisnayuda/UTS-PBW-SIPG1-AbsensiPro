<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link rel="stylesheet" href="{{ asset('dashboard.css') }}">
    <link rel="icon" href="{{ asset('images/Favicon.png') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        .btn-save {
            background: #1e3a8a;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .btn-back {
            background: #6b7280;
            color: white;
            padding: 10px 15px;
            border-radius: 8px;
            text-decoration: none;
            margin-left: 10px;
        }
    </style>
</head>
<body>

<div class="header">

    <div class="header-left">
        <h1 class="logo">AbsensiPro</h1>

        <div class="nav-menu">
            <a href="/dashboard" class="nav-link">Dashboard</a>
            <a href="/absensi" class="nav-link">Absensi</a>
            @if(auth()->user()->role == 'admin')
                <a href="{{ route('admin.users') }}" class="nav-link active">Akun</a>
            @endif
        </div>
    </div>

    <div class="user-menu">
        <span class="username" onclick="toggleDropdown()">
            <i class='bx bx-user'></i> {{ auth()->user()->name }}
        </span>

        <div id="dropdownMenu" class="dropdown">
            <a href="/profile" class="dropdown-item">
                <i class='bx bx-user-circle'></i> Profil
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dropdown-item logout">
                    <i class='bx bx-log-out'></i> Logout
                </button>
            </form>
        </div>
    </div>

</div>

<!-- content -->
<div class="content">

    <h2>Edit User</h2>

    <div class="box">

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf

            <label>Nama</label>
            <input type="text" name="name" value="{{ $user->name }}" required>

            <label>Email</label>
            <input type="email" name="email" value="{{ $user->email }}" required>

            <label>Password (opsional)</label>
            <input type="password" name="password" placeholder="Kosongkan jika tidak diubah">

            <br><br>

            <button class="btn-save">Simpan</button>
            <a href="/admin/users" class="btn-back">Kembali</a>
        </form>

    </div>

</div>

<script>
function toggleDropdown() {
    document.getElementById("dropdownMenu").classList.toggle("show");
}
</script>

</body>
</html>
