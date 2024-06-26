<?php

require_once __DIR__ . '/layout/header.php';
require_once __DIR__ . '/suppression.php';
require_once __DIR__ . '/classes/config.php';

$message = '';

session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: connexion.php');
    exit;
} else {
    //Update des values
    $user_id = $_SESSION['user_id'];
    if (isset($_POST['name']) && isset($_POST['login']) && isset($_POST['password'])) {

        $login = $_POST['login'];
        $name = $_POST['name'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $sql = "UPDATE users SET Name = :name, Login = :login, Password = :password WHERE Id_Users = :id";
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute(['name' => $name, 'login' => $login, 'password' => $password, 'id' => $user_id]);

        header('Location: settings.php');
    }
    //Init du form
    $query = "SELECT Name, Login, Is_Admin FROM users WHERE Id_Users = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => $user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$user) {
        echo "Utilisateur non trouvé.";
        unset($_SESSION['user_id']);
        exit;
    }
}

?>
    <div class="content">
    <div class="dashboard-container">
        <h2>Bienvenue sur votre tableau de bord</h2>
        <p>Vous pouvez maintenant accéder à toutes les fonctionnalités disponibles.</p>

        <?php
        if ($user['Is_Admin'] == 1) {
        ?>
            <a href="adminDashboard.php">Accéder au tableau de bord administrateur</a>
        <?php }
        ?>

        <div class="login-container">
            <?php if (!empty($message)) : ?>
                <p style="color:red"><?= $message ?></p>
            <?php endif; ?>

            <form action="settings.php" method="post">
                <div>
                    <label for="name">Nom d'utilisateur:</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['Name']); ?>">
                </div>
                <div>
                    <label for="login">Pseudo:</label>
                    <input type="text" id="login" name="login" value="<?php echo htmlspecialchars($user['Login']); ?>">
                </div>

                <div>
                    <label for=" password">Mot de passe:</label>
                    <input type="password" id="password" name="password">
                </div>

                <div>
                    <input type="submit" value="Modifier">
                </div>
            </form>
        </div>
        <a href="deconnexion.php">Se déconnecter</a>
        <form id="deleteForm" action="suppression.php" method="post" style="display:inline;">
            <input type="hidden" id="user_id" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
            <input type="hidden" id="location" name="location" value="settings">
            <button type="button" class="delete-button" onclick="confirmDelete()">Supprimer</button>
        </form>
    </div>
    </div>


<?php require_once __DIR__ . '/layout/footer.php'; ?>
