<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Laravel🌷</title>
<link rel="icon" href="{{ asset('title.jpeg') }}">

<style>
body {
    font-family: Arial;
    background: linear-gradient(135deg,#ffe6f0,#e6f7ff);
    margin: 0;
    padding: 30px;
}

.container {
    max-width: 700px;
    margin: auto;
    background: white;
    padding: 25px;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

h1 {
    text-align: center;
    color: #ff6fa5;
}

.user-card {
    padding: 10px;
    margin: 10px 0;
    border-radius: 12px;
    background: #fff5fa;
}

button {
    background: #ff6fa5;
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 10px;
    cursor: pointer;
}

button:hover {
    opacity: 0.9;
}

/* Modal */
.modal {
    display: none;
    position: fixed;
    top: 0; left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.4);
    justify-content: center;
    align-items: center;
}

.modal-content {
    background: white;
    padding: 20px;
    border-radius: 20px;
    width: 300px;
}

input {
    width: 100%;
    padding: 10px;
    margin: 8px 0;
    border-radius: 10px;
    border: 1px solid #ddd;
}
</style>
</head>

<body>

<div class="container">

    <h1>Cinnamon List 🐈🌷</h1>

    <button onclick="openModal()">➕ New Cinnamon 🐈🌷</button>
    <br> <br>
    <hr>

    @foreach ($users as $user)
        <div class="user-card">
            <strong>{{ $user->name }}</strong><br>
            <small>{{ $user->email }}</small>
        </div>
    @endforeach

</div>

<!-- 🌸 Modal -->
<div class="modal" id="modal">
    <div class="modal-content">

        <h3>🌷 Create Cinnamon</h3>

        <form method="POST" action="/users/register">
            @csrf

            <input type="text" name="name" placeholder="Name" required>

            <input type="email" name="email" placeholder="Email" required>

            <input type="password" name="password" placeholder="Password" required>

            <button type="submit">Create 🐱</button>
        </form>

        <br>

        <button onclick="closeModal()" style="background:#ccc;color:black;">
            Cancel
        </button>

    </div>
</div>

<script>
function openModal() {
    document.getElementById('modal').style.display = 'flex';
}

function closeModal() {
    document.getElementById('modal').style.display = 'none';
}
</script>

@extends('shared.footer')

</body>
</html>