<?php
	
	class User {

        private $id;
		private $username;
		private $password;
        private $id_role;

    public function __construct($id, $username, $password, $id_role) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->id_role = $id_role;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     *
     * @return self
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     *
     * @return self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdRole()
    {
        return $this->id_role;
    }

    /**
     * @param mixed $id_role
     *
     * @return self
     */
    public function setIdRole($id_role)
    {
        $this->id_role = $id_role;

        return $this;
    }
}

?>