<?php
/**
 * @Entity @Table(name="users")
 **/
class User
{
    private $errors;

    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;
    /**
     * @Column(type="string")
     **/
    protected $login;
    /** @Column(type="string") **/
    protected $password;
    /** @Column(type="string", nullable=true) **/
    protected $hash;

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = md5($password);
    }

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
     * @PrePersist @PreUpdate
     */
    public function validate($request)
    {
        $this->errors = array();

        $this->val_string($request['login'], 'логин');
        $this->val_string($request['password'], 'пароль');

        return (count($this->errors) > 0) ? false : true;
}

    public function getErrors()
    {
        return $this->errors;
    }

    public function val_string($field, $field_name) {
        switch (true) {
            case ($field == null):
                $this->errors[$field_name] = 'Заполните поле: '.$field_name;
                break;
            case (strlen($field) <= 3):
                $this->errors[$field_name] = 'Поле '.$field_name.' не может быть меньше 3 символов';
                break;
            case (strlen($$field) > 15):
                $this->errors[$field_name] = 'Поле '.$field_name.' не может быть больше 15 символов';
                break;
        }
    }
}