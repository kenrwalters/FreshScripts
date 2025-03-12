<?php

if ($argc != 3) {
    echo "Usage: php compare_csv.php <file1.csv> <file2.csv>\n";
    exit(1);
}

$file1 = $argv[1];
$file2 = $argv[2];

// read the file and return the rows as raw
function readCsv($filePath) {
    $rows = [];
    if (($handle = fopen($filePath, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 0, ",", "\"", "\\")) !== FALSE) {
            $rows[] = $data;
        }
        fclose($handle);
    }
    return $rows;
}

$csv1 = readCsv($file1);
$csv2 = readCsv($file2);

$maxRows = max(count($csv1), count($csv2));
$maxCols = max(count($csv1[0]), count($csv2[0]));

// compare each row of each column 
for ($i = 0; $i < $maxRows; $i++) {
    for ($j = 0; $j < $maxCols; $j++) {
        $value1 = isset($csv1[$i][$j]) ? $csv1[$i][$j] : null;
        $value2 = isset($csv2[$i][$j]) ? $csv2[$i][$j] : null;
        if ($value1 !== $value2) {
            echo "Difference at row $i, column $j: '$value1' vs '$value2'\n";
            /*
            echo "File 1 Row:\n";
            $fullRow = "";
            foreach ($csv1[$i] as $value) {
                $fullRow .= $value . ",";
            }
            echo "$fullRow\n";

            echo "File 2 Row:\n";
            $fullRow = "";
            foreach ($csv2[$i] as $value) {
                $fullRow .= $value . ",";
            }
            echo "$fullRow\n";
            */
            // only show 1 error per row
            //break;

        }
    }
}

?>