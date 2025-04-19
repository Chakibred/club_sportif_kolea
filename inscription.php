<?php
$host = 'sql301.infinityfree.com'; // Ton host InfinityFree
$db = 'csk_inscriptions';         // Ton nom de base de données
$user = 'if0_38776485';           // Ton nom d'utilisateur
$pass = 'chakibred';       // Ton mot de passe

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Dossier de stockage
$uploadDir = "uploads/";
if (!is_dir($uploadDir)) {
    mkdir($uploadDir);
}

// Récupération des données du formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$date_naissance = $_POST['date_naissance'];
$discipline = $_POST['discipline'];
$groupe_sanguin = $_POST['groupe_sanguin'];
$telephone = $_POST['telephone'];

// Gestion des fichiers
$certificat_medical = basename($_FILES['certificat_medical']['name']);
$photo = basename($_FILES['photo']['name']);
$acte_naissance = basename($_FILES['acte_naissance']['name']);

move_uploaded_file($_FILES['certificat_medical']['tmp_name'], $uploadDir . $certificat_medical);
move_uploaded_file($_FILES['photo']['tmp_name'], $uploadDir . $photo);
move_uploaded_file($_FILES['acte_naissance']['tmp_name'], $uploadDir . $acte_naissance);

// Requête SQL préparée
$sql = "INSERT INTO inscriptions 
(nom, prenom, date_naissance, discipline, groupe_sanguin, telephone, certificat_medical, photo, acte_naissance)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $pdo->prepare($sql);
$success = $stmt->execute([
    $nom,
    $prenom,
    $date_naissance,
    $discipline,
    $groupe_sanguin,
    $telephone,
    $certificat_medical,
    $photo,
    $acte_naissance
]);

if ($success) {
    echo "✅ Inscription réussie ! Merci.";
} else {
    echo "❌ Une erreur est survenue lors de l'inscription.";
}
?>
