<?php
class ContainrUserGroup extends CComponent {
	const SYSADMIN		= 5;
	const BACKENDADMIN	= 4;
	const BACKENDUSER	= 3;
	const FRONTENDADMIN	= 2;
	const FRONTENDUSER	= 1;
	const ALLLOGINS		= -1;
	const NOTLOGGEDIN	= -2;
	const EVERYONE		= -3;

	public static function getLabels() {
		$labels = array(
			ContainrUserGroup::SYSADMIN			=> 'Sysadmin',
			ContainrUserGroup::BACKENDADMIN		=> 'Backend admin',
			ContainrUserGroup::BACKENDUSER		=> 'Backend user',
			ContainrUserGroup::FRONTENDADMIN	=> 'Frontend admin',
			ContainrUserGroup::FRONTENDUSER		=> 'Frontend user',
			ContainrUserGroup::ALLLOGINS		=> 'All Logins',
			ContainrUserGroup::NOTLOGGEDIN		=> 'Not logged in',
			ContainrUserGroup::EVERYONE			=> 'Everyone',
		);
		return $labels;
	}

	public static function getGroupArray($withGlobals=false) {
		$labels = self::getLabels();
		$rtn = array();
		if ($withGlobals) {
			$rtn[ContainrUserGroup::ALLLOGINS] = $labels[ContainrUserGroup::ALLLOGINS];
			$rtn[ContainrUserGroup::NOTLOGGEDIN] = $labels[ContainrUserGroup::NOTLOGGEDIN];
		}
		$rtn[ContainrUserGroup::FRONTENDUSER] = $labels[ContainrUserGroup::FRONTENDUSER];
		$rtn[ContainrUserGroup::FRONTENDADMIN] = $labels[ContainrUserGroup::FRONTENDADMIN];
		$rtn[ContainrUserGroup::BACKENDUSER] = $labels[ContainrUserGroup::BACKENDUSER];
		$rtn[ContainrUserGroup::BACKENDADMIN] = $labels[ContainrUserGroup::BACKENDADMIN];
		$rtn[ContainrUserGroup::SYSADMIN] = $labels[ContainrUserGroup::SYSADMIN];
		return $rtn;
	}

	public static function checkPageAccessForCurrentUser($page) {
		$accessible = false;

		$groupaccess = self::_getCachedGroupAccess($page);

		if (count($groupaccess) > 0) {
			foreach ($groupaccess as $access) {
				if ($access->usergroup < 0) { //special groups
					if (
						($access->usergroup == ContainrUserGroup::ALLLOGINS && !Yii::app()->user->isGuest) ||
						($access->usergroup == ContainrUserGroup::NOTLOGGEDIN && Yii::app()->user->isGuest) ||
						($access->usergroup == ContainrUserGroup::EVERYONE)
						) {
						$accessible=true;
						break;
					}
				} else {
					if (!Yii::app()->user->isGuest && Yii::app()->user->role == $access->usergroup) {
						$accessible=true;
						break;
					}
				}
			}
		} else {
			$accessible = true;
		}

		return $accessible;
	}

	private static function _getCachedGroupAccess($page) {
		$groupaccess = $page->cachedGroupAccess;

		if (count($groupaccess) == 0) { //build cache
			$breadCrumb = $page->getBreadCrumb();
			$groupaccess = array();
			for ($i=count($breadCrumb)-1;$i>-1;$i--) {
				if (count($breadCrumb[$i]->groupAccess) > 0) {
					$groupaccess = $breadCrumb[$i]->groupAccess;
					break;
				}
			}
			if (count($groupaccess) == 0) { //still no restrictions, let's set -3, so we can cache it!
				$newAccess = new ContainrGroupAccessCache();
				$newAccess->type = 'page';
				$newAccess->elementId = $page->id;
				$newAccess->usergroup = -3;
				$newAccess->save();
				$groupaccess[] = $newAccess;
			} else {
				foreach ($groupaccess as $access) {
					$newAccess = new ContainrGroupAccessCache();
					$newAccess->type = 'page';
					$newAccess->elementId = $page->id;
					$newAccess->usergroup = $access->usergroup;
					$newAccess->save();
				}
			}
		}

		return $groupaccess;
	}

}