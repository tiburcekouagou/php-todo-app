<?php ob_start(); ?>

<h1>Ajouter une Nouvelle Tâche</h1>
<form action="/add" method="post">
    <input type="text" name="task" placeholder="Entrez la tâche" required>
    <button type="submit">Ajouter</button>
</form>

<?php $content = ob_get_clean(); ?>

<?php include "layout.php" ?>