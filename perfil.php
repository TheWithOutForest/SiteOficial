<?php
include 'conexao.php';
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuário</title>
    <link rel="stylesheet" href="/css/perfil.css">
</head>
<body>
    <div class="profile-container">
        <div class="menu-bar">
            <ul>
                <li><a href="#" class="active">Perfil</a></li>
                <li><a href="#">Configurações</a></li>
                <li><a href="#">Sair</a></li>
            </ul>
        </div>
        <div class="profile-content">
            <h2>Editar Perfil</h2>
            <div class="profile-info">
                <div class="profile-photo">
                    <img src="assets/avatar.png" alt="Foto de Perfil">
                    <form action="#" method="POST" enctype="multipart/form-data">
                        <label for="upload-photo" class="upload-btn">Escolher Foto</label>
                        <input type="file" id="upload-photo" name="profile-photo" style="display: none;">
                        <button type="submit" class="btn-save">Salvar Foto</button>
                    </form>
                </div>
                <div class="profile-details">
                    <form action="#" method="POST">
                        <div class="input-group">
                            <label for="first-name">Nome:</label>
                            <input type="text" id="first-name" name="first-name" value="João">
                        </div>
                        <div class="input-group">
                            <label for="last-name">Sobrenome:</label>
                            <input type="text" id="last-name" name="last-name" value="Silva">
                        </div>
                        <div class="input-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" value="joao@exemplo.com">
                        </div>
                        <div class="button-group">
                            <button type="submit" class="btn-save">Salvar</button>
                            <button type="reset" class="btn-cancel">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>