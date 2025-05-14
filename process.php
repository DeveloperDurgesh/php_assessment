<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sequence'])) {
    $input = trim($_POST['sequence']);
    $lines = array_filter(array_map('trim', explode("\n", $input)));

    $corrected = restructure_sequence($lines);

    echo json_encode([
        'status' => 'success',
        'data' => $corrected
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid input'
    ]);
}

function restructure_sequence($input) {
    $tree = [];

    // Step 1: Build hierarchy tree
    foreach ($input as $item) {
        $levels = explode('.', $item);
        $ref = &$tree;
        foreach ($levels as $level) {
            if (!isset($ref[$level])) {
                $ref[$level] = [];
            }
            $ref = &$ref[$level];
        }
    }

   
    $result = [];
    reindex_tree($tree, '', $result);
    return $result;
}

function reindex_tree($node, $prefix, &$result) {
    $index = 1;
    foreach ($node as $key => $child) {
        $newKey = ($prefix === '') ? $index : $prefix . '.' . $index;
        $result[] = (string)$newKey;
        reindex_tree($child, $newKey, $result);
        $index++;
    }
}

?>