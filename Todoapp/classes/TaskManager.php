<?php

    class TaskManager
    {
        private $db;

        public function __construct($db)
        {

            $this->db = $db;

        }

        public function create_task($description)
        {
            $sql = 'INSERT INTO tasks (description) VALUES (:description)';

            $stmt = $this->db->prepare($sql);
            $stmt->execute(['description' => $description]);

        }

        public function view_all_tasks()
        {
            $tasks = [];

            $stmt = $this->db->query('SELECT * FROM tasks');

            while($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                $tasks[] = $row;
            }
            
            return $tasks;

        }
            
        public function delete_task($task_id)
        {

            $stmt = $this->db->prepare("DELETE FROM tasks WHERE ID = :task_id");
            $stmt->bindParam(':task_id', $task_id);
            $stmt->execute();

        } 
    }

?>
