<?php

class Node {
    public $value;
    public $leftNode;
    public $rightNode;

    function __construct($value) {
        $this->value = $value;
        $this->leftNode = null;
        $this->rightNode = null;
    }
}

class BinaryTree {
    public $root;

    function __construct($array) {
        $this->root = $this->bTreee($array, 0);
    }

    private function bTreee($array, $index) {
        if ($index >= count($array) || $array[$index] == null) {
            return null;
        }

        $node = new Node($array[$index]);
        $node->leftNode = $this->bTreee($array, 2 * $index + 1); //for val
        // echo $node->left;exit;
        $node->rightNode = $this->bTreee($array, 2 * $index + 2);

        return $node;
    }


    private function maxSumBinTree($node, &$maxSum) {
        if ($node == null) {
            return 0;
        }

        $leftSum = max(0, $this->maxSumBinTree($node->leftNode, $maxSum));
        $rightSum = max(0, $this->maxSumBinTree($node->rightNode, $maxSum));

        $sum = $node->value + $leftSum + $rightSum;
        $maxSum = max($maxSum, $sum);

        return $node->value + max($leftSum, $rightSum);
    }

    public function maxSumPath() {
        $maxSum = PHP_INT_MIN;
        // $maxSum = 0;
        // echo $maxSum; exit;
        $this->maxSumBinTree($this->root, $maxSum);
        return $maxSum;
    }
}

$array = [-1,-2,-3,-5,-6,-7,-8,-11,-23,-43,-10,-12,-32,-34,-54];

$tree = new BinaryTree($array);
echo "Binary Tree MAX Sum : " . $tree->maxSumPath() . "\n";


?>
