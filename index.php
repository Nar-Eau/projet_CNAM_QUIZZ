<?php
require_once __DIR__ . '/layout/header.php';
require_once __DIR__ . '/classes/Database.php';

try {
    // Obtenir la connexion à la base de données
    $connection = Database::getConnection();
    // Utiliser $connection pour interagir avec la base de données
} catch (Exception $e) {
    // Gérer les erreurs de connexion
    echo $e->getMessage();
}
?>

<div class="content">
    <div class="headings">
        <div class="page-title">
            Bienvenue sur QuizIt
        </div>
        <div class="page-description">
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Molestiae optio cum debitis rerum cupiditate corporis corrupti reprehenderit iusto, harum pariatur numquam ad fugiat, tenetur iste dolor nobis voluptatibus nihil odit.
        </div>
    </div>

    <div class="topics-container">
        <div class="topic-item">
                <a href="modules.php?id_topic=1" class="topic-img">
                    <img src="./assets/img/cs.svg" alt="Cybersécurité">
                    <span class="title">Cybersécurité</span>
                </a>
            <div class="quiz-interaction">
                <a href="modules.php?id_topic=1" class="revision">
                    <img src="./assets/img/learn.svg">
                    <span>Révisions</span>
                </a>
                <a href="quiz.php?selection=true&id=1" class="quizz-start">
                    <img src="./assets/img/quiz.svg">
                    <span>Quiz</span>
                </a>
            </div>
            <div class="topic-description">
                <p>Retrouvez des questions autours des modules les plus importants de ce thème : Développement Web, Conteneurisation</p>
            </div>
        </div>
        <div class="topic-item">
            <a href="modules.php?id_topic=2" class="topic-img">
                <img src="./assets/img/dv.svg" alt="Développement">
                <span class="title">Développement</span>
            </a>
            <div class="quiz-interaction">
                <a href="modules.php?id_topic=2" class="revision">
                    <img src="./assets/img/learn.svg">
                    <span>Révisions</span>
                </a>
                <a href="quiz.php?selection=true&id=2" class="quizz-start">
                    <img src="./assets/img/quiz.svg">
                    <span>Quiz</span>
                </a>
            </div>
            <div class="topic-description">
                <p>Retrouvez des questions autours des modules les plus importants de ce thème : Développement Web, Conteneurisation</p>
            </div>
        </div>
    </div>
</div>

<div id="memorium">
    <div class="content">
        <div class="teams">
            <span>Développeurs</span>
            <ul>
                <li>Abdelghano</li>
                <li>Matéo</li>
                <li>Cody</li>
                <li>Alexandre</li>
                <li>Thomas</li>
            </ul>
        </div>
        <div class="teams">
            <span>Cybersécurité</span>
            <ul>
                <li>Bayane</li>
                <li>Mickael</li>
                <li>Arthur</li>
            </ul>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/layout/footer.php'; ?>

