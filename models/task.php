<?php
/**
 * @Entity @Table(name="tasks")
 **/
class Task
{

    private $errors;

    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;
    /** @Column(type="integer") **/
    protected $user_id;
    /** @Column(type="string") **/
    protected $task;
    /** @Column(type="boolean", options={"default": 0}) **/
    protected $is_complete;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_idid;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getTask()
    {
        return $this->task;
    }

    public function setTask($task)
    {
        $this->task = $task;
    }

    /**
     * @return mixed
     */
    public function getIsComplete()
    {
        return $this->is_complete;
    }

    public function setIsComplete($is_complete)
    {
        $this->is_complete = $is_complete;
    }

    public function validate($request)
    {
        $this->errors = array();

        $task = $request['task'];

        switch (true) {
            case ($task == null):
                $this->errors['задача'] = 'Заполните задачу';
                break;
            case (strlen($task) <= 3):
                $this->errors['задача'] = 'Задача не может быть меньше 3 символов';
                break;
            case (strlen($task) > 100):
                $this->errors['задача'] = 'Задача не может быть больше 100 символов';
                break;
        }

        return (count($this->errors) > 0) ? false : true;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}