<?php
/**
 * @Entity @Table(name="users")
 **/
class User
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;
    /** @Column(type="string") **/
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
     * @param mixed $login
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

}