<?php 
function checkRule($grid, $row, $col, $num)
{
    //row+
    for ($i = 0; $i < 9; $i++) {
        if ($grid[$row][$i] == $num) {
            return false;
        }
    }
    
    //col
    for ($j = 0; $j < 9; $j++) {
        if ($grid[$j][$col] == $num) {
            return false;
        }
    }
    
    //3rd rulw
    $ruleRow = $row - $row % 3;
    $rukeCol = $col - $col % 3;
    
    for ($i = 0; $i < 3; $i++) {
        for ($j = 0; $j < 3; $j++) {
            if ($grid[$i + $ruleRow][$j + $rukeCol] == $num) {
                return false;
            }
        }
    }
    
    return true;
}

function getNewGrid($grid) {
    if (sudoku($grid, 0, 0)) {
        return $grid;
    } else {
        return false;
    }
}

// Function to solve the Sudoku puzzle using backtracking
function sudoku(&$grid, $row, $col)
{
    if ($row == 9)
        return true; // Entire grid filled successfully
    if ($col == 9)
        return sudoku($grid, $row + 1, 0); // Move to the next row
    if ($grid[$row][$col] != 0)
        return sudoku($grid, $row, $col + 1); // Move to the next column

    for ($i = 1; $i <= 9; $i++) {
        if (checkRule($grid, $row, $col, $i)) {
            $grid[$row][$col] = $i;
            if (sudoku($grid, $row, $col + 1)) {
                return true;
            }
        }
        $grid[$row][$col] = 0; 
    }

    return false; 
}

$sudokuMatrix = [
    [5, 3, 0, 0, 7, 0, 0, 0, 0],
    [6, 0, 0, 1, 9, 5, 0, 0, 0],
    [0, 9, 8, 0, 0, 0, 0, 6, 0],
    [8, 0, 0, 0, 6, 0, 0, 0, 3],
    [4, 0, 0, 8, 0, 3, 0, 0, 1],
    [7, 0, 0, 0, 2, 0, 0, 0, 6],
    [0, 6, 0, 0, 0, 0, 2, 8, 0],
    [0, 0, 0, 4, 1, 9, 0, 0, 5],
    [0, 0, 0, 0, 8, 0, 0, 7, 9]
];

$solvedSudoku = getNewGrid($sudokuMatrix);

if ($solvedSudoku !== false) {
    for ($i = 0; $i < 9; $i++) {
        for ($j = 0; $j < 9; $j++) {
            echo $solvedSudoku[$i][$j] . " ";
        }
        echo "\n";
    }
} else {
    echo "Sudoku is invalid";
}

?>