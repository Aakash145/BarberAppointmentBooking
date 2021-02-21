<?php

class User {

    //Properties
    
	private $Name;
	private $user_id;
	private $role;
	private $username;
	private $email;
	private $Contact_Number;
    private $create_date;
	private $password;
	private $is_active;

	
    //Verify the password
	function verifyPassword(string $passwordInput)
	{
	
     return password_verify($passwordInput, $this->password);
	}
   

	//Setters
    
    /**
     * Set the value of Name
     *
     * @return  self
     */ 
    public function setName($Name)
    {
        $this->Name = $Name;

        return $this;
    }

	/**
	 * Set the value of role
	 *
	 * @return  self
	 */ 
	public function setRole($role)
	{
		$this->role = $role;

		return $this;
	}

	/**
	 * Set the value of username
	 *
	 * @return  self
	 */ 
	public function setUsername($username)
	{
		$this->username = $username;

		return $this;
	}

	/**
	 * Set the value of email
	 *
	 * @return  self
	 */ 
	public function setEmail($email)
	{
		$this->email = $email;

		return $this;
	}

	/**
	 * Set the value of Contact_Number
	 *
	 * @return  self
	 */ 
	public function setContact_Number($Contact_Number)
	{
		$this->Contact_Number = $Contact_Number;

		return $this;
	}

    /**
     * Set the value of create_date
     *
     * @return  self
     */ 
    public function setCreate_date($create_date)
    {
        $this->create_date = $create_date;

        return $this;
    }

	/**
	 * Set the value of password
	 *
	 * @return  self
	 */ 
	public function setPassword($password)
	{
		$this->password = $password;

		return $this;
	}

	/**
	 * Set the value of is_active
	 *
	 * @return  self
	 */ 
	public function setIs_active($is_active)
	{
		$this->is_active = $is_active;

		return $this;
	}

//Getters


    /**
     * Get the User_ID
     */ 
    public function getuser()
    {
        return $this->user_id;
	}
	
    /**
     * Get the value of Name
     */ 
    public function getName()
    {
        return $this->Name;
    }

	/**
	 * Get the value of role
	 */ 
	public function getRole()
	{
		return $this->role;
	}

	/**
	 * Get the value of username
	 */ 
	public function getUsername()
	{
		return $this->username;
	}

	/**
	 * Get the value of email
	 */ 
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * Get the value of Contact_Number
	 */ 
	public function getContact_Number()
	{
		return $this->Contact_Number;
	}

    /**
     * Get the value of create_date
     */ 
    public function getCreate_date()
    {
        return $this->create_date;
    }

	/**
	 * Get the value of password
	 */ 
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * Get the value of is_active
	 */ 
	public function getIs_active()
	{
		return $this->is_active;
	}
}



?>