<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class RegisterForm extends CFormModel
{
	public $username;
	public $password;
	public $passwordRepeat;
	public $email;
	public $firstname;
	public $lastname;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username, password, passwordRepeat, email, firstname, lastname', 'required'),
			array('username, firstname, lastname', 'length','max'=>128),
			array('password', 'compare', 'compareAttribute'=>'passwordRepeat'),
			array('email', 'email'),
			array('email','unique','className'=>'ContainrUser','attributeName'=>'email','message'=>'This email address is already registered'),
			array('username','unique','className'=>'ContainrUser','attributeName'=>'login','message'=>'This username is already registered'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'passwordRepeat'=>'Repeat password',
			'firstname'=>'First name',
			'lastname'=>'Last name',
		);
	}

}
