<?php

class Node
{
    public int $data;
    public $next;

    public function __construct(int $data, $next = null)
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

    public function prepend(int $data): void
    {
        $newHead = new Node($data);
        $newHead->next = $this->head;
        $this->head = $newHead;
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

    public function print(): void
    {
        if (is_null($this->head)) {
            echo "The list is empty";
        } else {
            $current = $this->head;
            echo $current->data . " ";

            while (!is_null($current->next)) {
                echo $current->next->data . " ";
                $current = $current->next;
            }
        }
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
$list->print();