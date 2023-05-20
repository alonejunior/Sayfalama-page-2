<?php
$db = new PDO('mysql:host=localhost;dbname=sayfalama', 'root', '');

// limit
$limit = 10;

// başlangıç
$baslangic = isset($_GET['baslangic']) ? intval($_GET['baslangic']) : 0;

if ($baslangic % $limit !== 0) {
    header('Location: index.php');
    exit();
}

$sorgu = $db->query('SELECT * FROM test ORDER BY id DESC LIMIT ' . $baslangic . ',' . $limit)->fetchAll(PDO::FETCH_ASSOC);

if (!$sorgu) {
    header('Location: index.php?baslangic=' . ($baslangic - $limit) . '&son=1');
    exit();
}

foreach ($sorgu as $veri) {
    echo $veri['id'] . '<br>';
}

if ($baslangic > 0) {
    echo '<a href="index.php?baslangic=' . ($baslangic - $limit) . '">Önceki Sayfa</a>';
}
if (count($sorgu) === $limit) {
    echo '<a href="index.php?baslangic=' . ($baslangic + $limit) . '">Sonraki Sayfa</a>';
}
?>