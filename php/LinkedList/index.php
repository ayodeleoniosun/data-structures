<?php

require_once "controller.php";

$list = new LinkedList();
$list->append(20);
$list->append(10);
$list->append(35);
$list->append(40);
$list->prepend(55);
$list->prepend(50);
$list->appendBeforeNode(5, 40);
$list->appendBeforeNode(95, 20);
$list->appendBeforeNode(95, 20);
$list->appendAfterNode(75, 40);
$list->appendAfterNode(85, 75);
$list->appendAfterNode(35, 20);
$list->delete(85);
$list->appendBeforeNode(45, 50);
$list->search(45);
$list->search(95);
$list->search(75);
$list->shift();
$list->search(45);
echo "The list has " . $list->count() . " nodes" . PHP_EOL;
$list->pop();
$list->delete(20);
$list->deleteAllNodes();

//remove duplicates
$list->append(7);
$list->append(10);
$list->append(7);
$list->append(8);
$list->append(7);
$list->removeDuplicates(7);
$list->print();

//sort
$list->append(-1);
$list->append(5);
$list->append(3);
$list->append(4);
$list->append(0);
echo "Sorted list = ";
$list->sort();
$list->print();
$list->deleteAllNodes();

//Palindrome
$list->append(1);
$list->append(3);
$list->append(4);
$list->append(7);
$list->append(1);
$list->append(8);
$list->print();

echo $list->isPalindrome() ? "Linked list is a palindrome" : "Linked list is not a palindrome";
echo PHP_EOL;

//middle nodes
$middleElement = $list->getMiddleElement();
echo "The middle element is " . $middleElement;
echo PHP_EOL;
$list->deleteMiddleNode($middleElement);
$list->print();

//merge sorted lists
$list1 = new LinkedList();
$list1->append(5);
$list1->append(7);
$list1->append(9);
$list1->append(10);

$list2 = new LinkedList();
$list2->append(3);
$list2->append(4);
$list2->append(8);
$list2->append(10);

$mergeLists = new MergeLinkedList($list1, $list2);
echo "Merged sorted list = ";
$mergeLists->merge();
$mergeLists->print();