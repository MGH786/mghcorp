<?php
header('Content-Type: text/plain; charset=utf-8');
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); echo "Methode non autorisee"; exit; }
$prenom = trim($_POST['p'] ?? '');
$entreprise = trim($_POST['e'] ?? '');
$email_visiteur = trim($_POST['m'] ?? '');
$offre = trim($_POST['o'] ?? '');
$message = trim($_POST['t'] ?? '');
if (empty($prenom) || empty($email_visiteur) || empty($message)) { http_response_code(400); echo "Champs manquants"; exit; }
if (!filter_var($email_visiteur, FILTER_VALIDATE_EMAIL)) { http_response_code(400); echo "Email invalide"; exit; }
$to = "contact@mghcorp.fr";
$subject = "Demande mghcorp - " . $prenom . " - " . $offre;
$body = "Nouvelle demande mghcorp.fr\nPrenom: $prenom\nEntreprise: $entreprise\nEmail: $email_visiteur\nPrestation: $offre\n\n$message\n";
$headers = "From: MGHCorp <contact@mghcorp.fr>\r\nReply-To: $email_visiteur\r\nContent-Type: text/plain; charset=utf-8\r\n";
if (mail($to, $subject, $body, $headers)) { echo "OK - envoye"; } else { http_response_code(500); echo "Erreur mail"; }
?>
