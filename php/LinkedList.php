<?php

class Node
{
    public ?int $data;
    public $next;

    public function __construct(?int $data = null, $next = null)
    {
        $this->data = $data;
        $this->next = $next;
    }
}

class LinkedList
{
    public $head;
    public $sortTypes = ['asc', 'desc'];

    public function __construct()
    {
        $this->head = null;
    }

    public function append(int $data): void
    {
        $node = new Node($data);

        if (is_null($this->head)) {
            $this->head = $node;
            return;
        }

        $current = $this->head;

        while (!is_null($current->next)) {
            $current = $current->next;
        }

        $current->next = $node;
    }


    public function appendBeforeNode(int $data, int $target): void
    {
        $node = new Node($data);

        if (is_null($this->head) || $this->head->data == $target) {
            $node->next = $this->head;
            $this->head = $node;
            return;
        }

        $current = $this->head;

        while (!is_null($current->next)) {
            if ($current->next->data == $target) {
                $node->next = $current->next;
                $current->next = $node;
                return;
            }

            $current = $current->next;
        }
    }

    public function appendAfterNode(int $data, int $target): void
    {
        $node = new Node($data);

        if (is_null($this->head)) {
            $this->head = $node;
            return;
        }

        if ($this->head->data == $target) {
            $node->next = $this->head->next;
            $this->head->next = $node;
            return;
        }

        $current = $this->head;

        while (!is_null($current->next)) {
            if ($current->data == $target) {
                $node->next = $current->next;
                $current->next = $node;
                return;
            }

            $current = $current->next;
        }

        $current->next = $node;
    }

    public function prepend(int $data): void
    {
        $newHead = new Node($data);
        $newHead->next = $this->head;
        $this->head = $newHead;
    }

    public function search(int $data): void
    {
        if (is_null($this->head)) {
            echo $data . " not found" . PHP_EOL;
            return;
        }

        if ($this->head->data == $data) {
            echo $data . " found on the head" . PHP_EOL;
            return;
        }

        $current = $this->head;
        $index = 0;

        while ($current) {
            if ($current->data == $data) {
                if (is_null($current->next)) {
                    echo $data . " found on tail " . PHP_EOL;
                } else {
                    echo $data . " found on index " . $index . "" . PHP_EOL;
                }
                return;
            }
            $current = $current->next;
            $index++;
        }

        echo $data . " not found" . PHP_EOL;
    }

    public function count(): int
    {
        if (is_null($this->head)) {
            return 0;
        }

        if (is_null($this->head->next)) {
            return 1;
        }

        $i = 0;
        $current = $this->head;

        while (!is_null($current->next)) {
            $i++;
            $current = $current->next;
        }

        return $i;
    }

    public function isPalindrome(): bool
    {
        if (is_null($this->head)) {
            return false;
        }

        if (is_null($this->head->next)) {
            return true;
        }

        $current = $this->head;
        $stack = [];

        while (!is_null($current)) {
            $stack[] = $current->data;
            $current = $current->next;
        }

        $palindrome = $this->head;

        while (!is_null($palindrome)) {
            if ($palindrome->data != array_pop($stack)) {
                return false;
            }

            $palindrome = $palindrome->next;
        }

        return true;
    }

    public function getMiddleElement()
    {
        if (is_null($this->head)) {
            return;
        }

        if (is_null($this->head->next)) {
            return $this->head->data;
        }

        $fast = $this->head;
        $slow = $this->head;

        while (!is_null($fast) && !is_null($fast->next)) {
            $fast = $fast->next->next;
            $slow = $slow->next;
        }

        return $slow->data;
    }

    public function delete(int $data): void
    {
        if (is_null($this->head)) {
            return;
        }

        while (!is_null($this->head) && ($this->head->data == $data)) {
            $this->head = $this->head->next;
        }

        $current = $this->head;

        while (!is_null($current) && !is_null($current->next)) {
            if ($current->next->data == $data) {
                $current->next = $current->next->next;
            } else {
                $current = $current->next;
            }
        }
    }

    public function shift(): void
    {
        if (is_null($this->head)) {
            return;
        }

        $this->head = $this->head->next;
    }

    public function pop(): void
    {
        if (is_null($this->head)) {
            return;
        }

        if (is_null($this->head->next)) {
            $this->head = null;
            return;
        }

        $current = $this->head;

        while (!is_null($current->next->next)) {
            $current = $current->next;
        }

        $current->next = null;
    }

    public function deleteAllNodes(): void
    {
        if (is_null($this->head)) {
            return;
        }

        if (is_null($this->head->next)) {
            $this->head = null;
            return;
        }

        while (!is_null($this->head)) {
            $temp = $this->head;
            $this->head = $this->head->next;
            $temp = null;
        }

        echo "All nodes deleted" . PHP_EOL;
    }

    public function removeDuplicates(): void
    {
        if (is_null($this->head)) {
            return;
        }

        $this->head = $this->sort();
        $current = $this->head;

        while (!is_null($current->next)) {
            if ($current->data == $current->next->data) {
                $current->next = $current->next->next;
            } else {
                $current = $current->next;
            }
        }
    }

    public function sort($type = null)
    {
        if (is_null($this->head)) {
            return;
        }

        $type = !is_null($type) ? strtolower($type) : $type;

        $current = $this->head;

        while (!is_null($current)) {
            if (!is_null($type) && !in_array($type, $this->sortTypes)) {
                return;
            }

            $index = $current->next;

            while (!is_null($index)) {
                if ((is_null($type) || ($type == 'asc')) && $current->data > $index->data) {
                    $temp = $current->data;
                    $current->data = $index->data;
                    $index->data = $temp;
                } elseif ($type == 'desc' && $current->data < $index->data) {
                    $temp = $index->data;
                    $index->data = $current->data;
                    $current->data = $temp;
                }

                $index = $index->next;
            }
            $current = $current->next;
        }

        return $this->head;
    }

    public function print(): void
    {
        if (is_null($this->head)) {
            echo "The list is empty" . PHP_EOL;
            return;
        }

        $current = $this->head;
        echo $current->data . " ";

        while (!is_null($current->next)) {
            echo $current->next->data . " ";
            $current = $current->next;
        }
        echo PHP_EOL;
    }
}

class MergeLinkedList
{
    public $head;
    public LinkedList $list1;
    public LinkedList $list2;

    public function __construct(LinkedList $list1, LinkedList $list2)
    {
        $this->list1 = $list1;
        $this->list2 = $list2;
    }

    public function merge()
    {
        $list1 = $this->list1->head;
        $list2 = $this->list2->head;

        if (is_null($list1)) {
            return $list2;
        }

        if (is_null($list2)) {
            return $list1;
        }

        $temp = new Node();
        $this->head = $temp;

        while (!is_null($list1) && !is_null($list2)) {
            if ($list1->data <= $list2->data) {
                $temp->next = $list1;
                $list1 = $list1->next;
            } else {
                $temp->next = $list2;
                $list2 = $list2->next;
            }
            $temp = $temp->next;
        }

        if (is_null($list1)) {
            $temp->next = $list2;
        } else if (is_null($list2)) {
            $temp->next = $list1;
        }

        return $this->head;
    }

    public function print(): void
    {
        if (is_null($this->head)) {
            echo "The list is empty" . PHP_EOL;
            return;
        }

        $current = $this->head;
        echo $current->data . " ";

        while (!is_null($current->next)) {
            echo $current->next->data . " ";
            $current = $current->next;
        }
        echo PHP_EOL;
    }
}


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
$list->append(3);
$list->append(7);
$list->append(1);
$list->append(8);
$list->print();

echo $list->isPalindrome() ? "Linked list is a palindrome" : "Linked list is not a palindrome";
echo PHP_EOL;

echo "The middle element is " . $list->getMiddleElement();
echo PHP_EOL;

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


