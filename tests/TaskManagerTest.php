<?php


namespace Ludov\UnitTestTp;

use Ludov\UnitTestTp\TaskManager;

class TaskManagerTest extends \PHPUnit\Framework\TestCase{

    public function testAddTask(){
        $taskManager = new TaskManager();

        $taskManager->addTask("task1");
        $this->assertEquals("task1", $taskManager->getTask(0));

        $taskManager->addTask("task2");
        $this->assertEquals("task2", $taskManager->getTask(1));
    }

    public function testRemoveTask(){
        $taskManager = new TaskManager();

        $taskManager->addTask("task1");
        $taskManager->addTask("task2");
        $taskManager->removeTask(0);

        $this->assertEquals(["task2"], $taskManager->getTasks());
    }

    public function testGetTasks(){
        $taskManager = new TaskManager();

        $taskManager->addTask("task1");
        $taskManager->addTask("task2");

        $this->assertEquals(["task1","task2"], $taskManager->getTasks());
    }

    public function testGetTask(){
        $taskManager = new TaskManager();

        $taskManager->addTask("task1");
        $this->assertEquals("task1", $taskManager->getTask(0));

        $taskManager->addTask("task2");
        $this->assertEquals("task2", $taskManager->getTask(1));
    }

    public function testRemoveInvalidIndexThrowsException(){
        $taskManager = new TaskManager();

        $this->expectException(\OutOfBoundsException::class);
        $this->expectExceptionMessage("Index de tâche invalide: 99");

        $taskManager->removeTask(99);
    }

    public function testGetInvalidIndexThrowsException(){
        $taskManager = new TaskManager();

        $this->expectException(\OutOfBoundsException::class);
        $this->expectExceptionMessage("Index de tâche invalide: 99");
        $taskManager->getTask(99);
    }

    public function testTaskOrderAfterRemoval(){
        $taskManager = new TaskManager();

        $taskManager->addTask("task1");
        $this->assertEquals("task1", $taskManager->getTask(0));

        $taskManager->addTask("task2");
        $this->assertEquals("task2", $taskManager->getTask(1));

        $taskManager->addTask("task3");
        $this->assertEquals("task3", $taskManager->getTask(2));

        $taskManager->removeTask(1);
        $this->assertEquals(["task1","task3"], $taskManager->getTasks());

    }

}

?>