<?php
function searchInPage($page, $searchTerm) {
    $results = [];
    switch ($page) {
        case 'sermones':
            // Buscar en sermones
            $results[] = [
                'title' => 'Fortaleza en medio de la tormenta',
                'description' => 'Sermón basado en Salmos 46:1-3',
                'url' => 'sermones.php'
            ];
            break;
        case 'eventos':
            global $pdo;
            // Buscar en eventos de la base de datos
            $stmt = $pdo->prepare("SELECT * FROM eventos WHERE titulo LIKE ? OR descripcion LIKE ?");
            $searchPattern = "%{$searchTerm}%";
            $stmt->execute([$searchPattern, $searchPattern]);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $results[] = [
                    'title' => $row['titulo'],
                    'description' => $row['descripcion'],
                    'url' => 'eventos.php#evento-' . $row['id']
                ];
            }
            break;
        case 'pastores':
            global $pdo;
            // Buscar en pastores de la base de datos
            $stmt = $pdo->prepare("SELECT * FROM pastores WHERE nombre_completo LIKE ? OR descripcion LIKE ?");
            $searchPattern = "%{$searchTerm}%";
            $stmt->execute([$searchPattern, $searchPattern]);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $results[] = [
                    'title' => $row['nombre_completo'],
                    'description' => $row['descripcion'],
                    'url' => 'pastores.php#pastor-' . $row['id']
                ];
            }
            break;
        case 'ministerios':
            // Buscar en ministerios
            if (stripos('ministerio de alabanza', $searchTerm) !== false) {
                $results[] = [
                    'title' => 'Ministerio de Alabanza',
                    'description' => 'Responsables de dirigir la adoración durante los cultos.',
                    'url' => 'ministerios.php#alabanza'
                ];
            }
            if (stripos('ministerio de evangelismo', $searchTerm) !== false) {
                $results[] = [
                    'title' => 'Ministerio de Evangelismo',
                    'description' => 'Encargados de llevar el mensaje del evangelio a la comunidad.',
                    'url' => 'ministerios.php#evangelismo'
                ];
            }
            break;
    }
    return $results;
}

// Procesar la búsqueda
if (isset($_GET['q']) && !empty($_GET['q'])) {
    require_once(__DIR__ . '/../config/db.php');
    
    $searchTerm = trim($_GET['q']);
    $currentPage = basename($_SERVER['PHP_SELF'], '.php');
    $results = searchInPage($currentPage, $searchTerm);
    
    if (empty($results)) {
        echo '<div class="alert alert-warning mt-3" role="alert">
                No se encontraron resultados para "<strong>' . htmlspecialchars($searchTerm) . '</strong>"
              </div>';
    } else {
        echo '<div class="mt-3">';
        foreach ($results as $result) {
            echo '<div class="card mb-2">
                    <div class="card-body">
                        <h5 class="card-title">' . htmlspecialchars($result['title']) . '</h5>
                        <p class="card-text">' . htmlspecialchars($result['description']) . '</p>
                        <a href="' . $result['url'] . '" class="btn btn-primary">Ver más</a>
                    </div>
                  </div>';
        }
        echo '</div>';
    }
    exit;
}
?>
