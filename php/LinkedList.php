<?php

class Node
{
    public int $data;
    public $next;

    public function __construct(int $data = null, $next = null)
    {
        $this->data = $data;
        $this->next = $next;
    }
}

class LinkedList
{
    public $head;

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

    public function delete(int $data): void
    {
        if (is_null($this->head)) {
            return;
        }

        if ($this->head->data == $data) {
            $this->head = $this->head->next;
            return;
        }

        $current = $this->head;

        while (!is_null($current->next)) {
            if ($current->next->data == $data) {
                $current->next = $current->next->next;
                return;
            }
            $current = $current->next;
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
$list->delete(35);
$list->appendBeforeNode(5, 40);
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
$list->pop();
$list->pop();
$list->deleteAllNodes();
$list->print();