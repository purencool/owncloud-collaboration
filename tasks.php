<?php
/**
 * ownCloud - collaboration plugin
 *
 * @authors Dr.J.Akilandeswari, R.Ramki, R.Sasidharan, P.Suresh
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU AFFERO GENERAL PUBLIC LICENSE
 * License as published by the Free Software Foundation; either
 * version 3 of the License, or any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU AFFERO GENERAL PUBLIC LICENSE for more details.
 *
 * You should have received a copy of the GNU Affero General Public
 * License along with this library.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

\OCP\User::checkLoggedIn();
\OCP\App::checkAppEnabled('collaboration');

OCP\App::setActiveNavigationEntry( 'collaboration' );


OCP\Util::addScript('collaboration', 'tasks');


OCP\Util::addStyle('collaboration', 'tabs');
OCP\Util::addStyle('collaboration', 'content_header');
OCP\Util::addStyle('collaboration', 'tasks');

$tpl = new OCP\Template("collaboration", "tasks", "user");

$args = array(
	'project'=>NULL,
	'status'=>NULL,
	'assigned_by'=>NULL,
	'assigned_to'=>NULL);

if(isset($_GET['taskps']) && $_GET['taskps'] != 'ALL')
{


	//if(!OC_Collaboration_Project::isMemberWorkingOnProjectByTitle(OC_User::getUser(), $_GET['taskps']))
//	{
	//	header('Location: ' . \OCP\Util::linkToRoute('collaboration_route', array('rel_path'=>'dashboard')));
		//throw new Exception(OC_User::getUser() . ' is trying to access project ' . $_GET['taskps']);
	//	exit();
//	}
//	else
//	{
		$tpl->assign('tasks_by_project', $_GET['taskps']);
		$args['tasks_by_project'] = $_GET['taskps'];
//	}
}


if(isset($_GET['status']) && $_GET['status'] != 'ALL')
{
	$tpl->assign('status', $_GET['status']);
	$args['status'] = $_GET['status'];
}

if(!isset($_GET['assigned_by']) && !isset($_GET['assigned_to']))
{
	$_GET['assigned_by'] = $_GET['assigned_to'] = 'on';
}

if(isset($_GET['assigned_by']))
{
	$tpl->assign('assigned_by', $_GET['assigned_by']);
	$args['assigned_by'] = OC_User::getUser();
}

if(isset($_GET['assigned_to']))
{
	$tpl->assign('assigned_to', $_GET['assigned_to']);
	$args['assigned_to'] = OC_User::getUser();
}

$tpl->assign('tasks', OC_Collaboration_Task::readTasks($args));
$tpl->assign('project_select', OC_Collaboration_Task::sortProjectsTasks());

$tpl->printPage();
?>
