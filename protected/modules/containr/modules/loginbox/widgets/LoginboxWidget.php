<?php

class LoginboxWidget extends ContainrBaseWidget
{

	public $pageCode = '';

	public function init() {
		// this method is called by CController::beginWidget()
	}

	public function run() {
		if (!isset($_GET['mode'])) {
			$_GET['mode'] = '';
		}

		$model = Loginbox::model()->findByPK( $this->elemId );
		if (
			(!$model->enableRegistration && $_GET['mode'] == 'register') ||
			($model->doubleoptin == 0 && $_GET['mode'] == 'activate')
		) {
			$_GET['mode']='';
		}
		switch ($_GET['mode']) {
			case 'register':
				$this->runRegisterForm($model);
				break;
			case 'activate':
				$this->runUserActivation($model);
				break;
			default:
				$this->runLoginForm($model);
				break;
		}
	}

	public function runLoginForm($model) {
		$formModel = new LoginForm();

		if(isset($_POST['LoginForm'])) {
			$formModel->attributes = $_POST['LoginForm'];

			// validate user input and redirect to the previous page if valid
			if($formModel->validate() && $formModel->login()) {
				$targetPage = ContainrPage::model()->visibleOnly()->findByPK($model->redirectAfterLogin);
				$url = '/';
				if (!is_null($targetPage)) {
					$url = $this->controller->createUrl('/' . $targetPage->code);
				}
				$this->controller->redirect($url);
			} else {

				$this->controller->renderPartial('application.modules.containr.modules.loginbox.views.forms.login',array('model'=>$model,'formModel'=>$formModel));
			}
		} else {
			$this->controller->renderPartial('application.modules.containr.modules.loginbox.views.forms.login',array('model'=>$model,'formModel'=>$formModel));
		}
	}

	public function runRegisterForm($model) {
		$formModel = new RegisterForm();

		if(isset($_POST['RegisterForm'])) {
			$formModel->attributes = $_POST['RegisterForm'];

			// validate user input and redirect to the previous page if valid
			if($formModel->validate()) {
					//create new user
					$user = new ContainrUser;
					$user->nameFirst = $formModel->firstname;
					$user->nameLast = $formModel->lastname;
					$user->email = $formModel->email;
					$user->login = $formModel->username;
					$user->passwordConfirm = $user->password = crypt($formModel->password);
					if ($model->doubleoptin>0) {
						$user->role = 0;
					} else {
						$user->role = 1;
					}
					$user->save();
					if ($model->doubleoptin>0) {
						//create random number
						$rnd = 0;
						for ($i=0;$i<10;$i++) {
							$rnd += rand(0,9);
							$rnd *= 10;
						}
						$rnd .= time();

						$userHash = new ContainrUserHash;
						$userHash->hashtype = ContainrUserHash::TYPE_REGISTER;
						$userHash->hash = md5($rnd);
						$userHash->user_id = $user->id;
						$userHash->save();


						$message = new YiiMailMessage('Thank you for your registration');
						$message->view = 'doubleOptIn';

						//userModel is passed to the view
						$message->setBody(array('user'=>$user,'hash'=>$userHash), 'text/html');

						$message->addTo($user->email);
						$message->from = Yii::app()->params['adminEmail'];
						Yii::app()->mail->send($message);
					}

				$this->controller->renderPartial('application.modules.containr.modules.loginbox.views.forms.registrationSuccessful',array('model'=>$model));
			} else {
				$this->controller->renderPartial('application.modules.containr.modules.loginbox.views.forms.registration',array('model'=>$model,'formModel'=>$formModel));
			}
		} else {
			$this->controller->renderPartial('application.modules.containr.modules.loginbox.views.forms.registration',array('model'=>$model,'formModel'=>$formModel));
		}
	}

	public function runUserActivation($model) {
		$user = ContainrUser::model()->findByPK($_GET['user']);
		$hash = ContainrUserHash::model()->findByAttributes(array('user_id'=>$_GET['user'],'hash'=>$_GET['ac'],'hashtype'=>ContainrUserHash::TYPE_REGISTER));
		if (is_null($user) || is_null($hash)) {
			$this->controller->renderPartial('application.modules.containr.modules.loginbox.views.activation.userOrHashNotFound');
		} else {
			$user->role=1;
			$user->passwordConfirm = 'x';
			$user->save();
			$hash->delete();
			$this->controller->renderPartial('application.modules.containr.modules.loginbox.views.activation.userActivated');
		}
	}

}
