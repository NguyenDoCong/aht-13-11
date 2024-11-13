<?php
class Element
{
    public $value;
    public $next;
}
class Queue
{
    private $front = null;
    private $back = null;

    /**
     * Check whether the queue is empty or not
     *@returnboolean
     * public function isEmpty(){ return false; }  //stub
     */
    public function isEmpty()
    {
        return $this->front == null;
    }

    /**
     * Insert element at the back of queue
     *@param$value
     * public function enqueue($value){} //stub
     */
    public function enqueue($value)
    {
        $oldBack = $this->back;
        $this->back = new Element();
        $this->back->value = $value;
        if ($this->isEmpty()) {
            $this->front = $this->back;
        } else {
            $oldBack->next = $this->back;
        }
    }

    /**
     * Remove element from the front of queue
     *@return$value
     * public function dequeue(){ return 0; } //stub
     */
    public function dequeue()
    {
        if ($this->isEmpty()) {
            return null;
        }
        $removedValue = $this->front->value;
        $this->front = $this->front->next;
        return $removedValue;
    }
}

$queue = new Queue();
$queue->enqueue("start");
$queue->enqueue(1);
$queue->enqueue(2);

echo $queue->dequeue() . "\n";
echo $queue->dequeue() . "\n";

echo $queue->isEmpty() ? "The queue is empty" : "The queue is not empty";
echo "\n";

$queue->enqueue(3);
$queue->enqueue(4);

echo $queue->dequeue() . "\n";
echo $queue->dequeue() . "\n";
echo $queue->dequeue() . "\n";

echo $queue->isEmpty() ? "The queue is empty" : "The queue is not empty";
echo "\n";
