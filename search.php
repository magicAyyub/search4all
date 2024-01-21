<?php
# Limite de temps à ne pas dépasser 
set_time_limit(120); 

# query string
$query = isset($_GET['q']) ? $_GET['q'] : ''; 

# Search function
function searchFiles($startDirectory, $query) {
    $queue = new SplQueue();
    $queue->enqueue($startDirectory);
   
    $resultsArray = [];

    while (!$queue->isEmpty()) {
        $currentDir = $queue->dequeue();
        $contents = scandir($currentDir);

       
        foreach ($contents as $item) {
            if ($item != '.' && $item != '..') {
                $path = $currentDir . '/' . $item;

                if (is_dir($path)) {
                    $queue->enqueue($path);
                } elseif (stripos(formatForComparison($item), formatForComparison($query)) !== false) {
                    $resultsArray[] = $path;
                    #return json_encode([$path]);
                }
            }
        }
        
    }

    if (empty($resultsArray)) {
        $resultsArray[] = "Aucun résultat trouvé pour \"$query\"";
        #return  json_encode(["Aucun résultat trouvé pour \"$query\""]);
    }

    echo json_encode($resultsArray);
}

# format string function
function formatForComparison($text) {
    return str_replace(' ', '', strtolower($text));
}


$configFile = __DIR__ . '/config.json';

if (file_exists($configFile)) {
    // Read the JSON file
    $config = json_decode(file_get_contents($configFile), true);

    // Get values from the config
    $rootFolder = isset($config['rootFolder']) ? $config['rootFolder'] : '';
} else 
    $rootFolder = '/';


echo searchFiles($rootFolder, $query);


