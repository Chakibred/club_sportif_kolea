<?php
// Connexion à la base de données
$host = 'sql301.infinityfree.com'; // Ton host InfinityFree
$db = 'csk_inscriptions';         // Ton nom de base de données
$user = 'if0_38776485';           // Ton nom d'utilisateur
$pass = 'chakibred';       // Ton mot de passe

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Récupérer les inscriptions
$stmt = $pdo->query("SELECT * FROM inscriptions");
$inscriptions = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin - Inscriptions</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        th { background-color: #007bff; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
        h1 { color: #333; }
        a { text-decoration: none; color: #007bff; }
    </style>
</head>
<body>
    <h1>Liste des inscriptions</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Date de naissance</th>
            <th>Discipline</th>
            <th>Groupe sanguin</th>
            <th>Téléphone</th>
            <th>Certificat</th>
            <th>Photo</th>
            <th>Acte de naissance</th>
        </tr>
        <?php foreach ($inscriptions as $inscrit): ?>
        <tr>
            <td><?= $inscrit['id'] ?></td>
            <td><?= htmlspecialchars($inscrit['nom']) ?></td>
            <td><?= htmlspecialchars($inscrit['prenom']) ?></td>
            <td><?= htmlspecialchars($inscrit['date_naissance']) ?></td>
            <td><?= htmlspecialchars($inscrit['discipline']) ?></td>
            <td><?= htmlspecialchars($inscrit['groupe_sanguin']) ?></td>
            <td><?= htmlspecialchars($inscrit['telephone']) ?></td>
            <td><a href="uploads/<?= $inscrit['certificat_medical'] ?>" target="_blank">Voir</a></td>
            <td><a href="uploads/<?= $inscrit['photo'] ?>" target="_blank">Voir</a></td>
            <td><a href="uploads/<?= $inscrit['acte_naissance'] ?>" target="_blank">Voir</a></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
