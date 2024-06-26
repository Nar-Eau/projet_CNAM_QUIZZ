<?php
require_once __DIR__ . '/layout/header.php';
require_once __DIR__ . '/classes/config.php';
require_once __DIR__ . '/functions/utils.php';



$user_id = testLogin();

if (isset($_GET['id_topic'])) {
    $Id_Topic = $_GET['id_topic'];
    $stmt = $pdo->prepare("SELECT topics.Name, modules.* 
    FROM topics
    INNER JOIN modules ON topics.Id_Topics = modules.Id_Topics
    WHERE topics.Id_Topics = :Id_Topic"); 
    $stmt->execute(['Id_Topic' => $Id_Topic]);
    $modules = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {    
    header('Location: index.php');
}

?>

<div class="content">
    <div class="headings">
        <div class="page-title">
            Modules pour <?php echo $modules[0]['Name'] ?>
        </div>
        <div class="page-description">
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Molestiae optio cum debitis rerum cupiditate corporis corrupti reprehenderit iusto, harum pariatur numquam ad fugiat, tenetur iste dolor nobis voluptatibus nihil odit.
        </div>
    </div>
    <div class="module-list">
    <?php foreach ($modules as $module):?>
        <div class="modules-container">
            <h2><?php echo $module['Name'] ; ?></h2>      
            <div class="score">
                <?php 
                
                $stmt = $pdo->prepare("SELECT * FROM score_modules WHERE score_modules.Id_Modules = :Id_Modules AND score_modules.Id_Users = :Id_Users"); 
                $stmt->execute(['Id_Modules' => $module['Id_Modules'], 'Id_Users' => $user_id]);
                $score = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (empty($score[0]["Score"])) {
                    $score[0]["Score"] = "*";
                }
                ?>
                <label for="score"><b>Score : </b><?php echo $score[0]['Score']; ?>/10</label>
            </div>
            <div>
            <form action="quiz.php" method="get">
                <button type="submit" name="id" value=<?php echo $module['Id_Modules'];?>>Accéder</button>
            </form>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>



<?php require_once __DIR__ . '/layout/footer.php'; ?>