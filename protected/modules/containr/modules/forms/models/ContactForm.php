<?php

class ContactForm extends CFormModel
{
    public $name;
    public $email;
    public $subject;
    public $message;
	public $verifyCode;

    public function rules()
    {
        return array(
            array('name,email,subject,message,verifyCode', 'required'),
			array('verifyCode', 'captcha', 'allowEmpty'=>!extension_loaded('gd')),
            array('email','email')
        );
    }

    /**
     *
     *
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'name'=>'Name',
            'email'=>'E-Mail-Adresse',
            'subject'=>'Betreff',
            'message'=>'Ihre Mitteilung',
			'verifyCode'=>'Captcha'
        );
    }

    public function submit($model = null){

        $subject = $model->mailSubject . ': ' . $this->subject;
        $to = $model->mailRecipient;
        $header =   'From: GiantBits Kontaktformular <noreply@giantbits.com>' . "\r\n" .
                    'Reply-To: ' . $this->email . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

        mail($to,$subject,$this->message."\r\n--------------\r\n".$this->name."\n\r".$model->mailRecipient,$header);

    }
}
