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


OCP\Util::addScript('collaboration', 'display_message');


OCP\Util::addStyle('collaboration', 'tabs');
OCP\Util::addStyle('collaboration', 'content_header');
OCP\Util::addStyle('collaboration', 'display_message');

$l = OC_L10N::get('collaboration');

$tpl = new OCP\Template('collaboration', 'display_message', 'user');

if($_GET['task'] != false && $_GET['task'] != 0)
{
	$tpl->assign('title', $l->t('Success'));
	$tpl->assign('msg', $l->t('Task \'%s\' has been created successfully.', array($_GET['title'])));

	OC_Collaboration_Task::addEvent($_GET['task'], $_GET['event_id']);
}
else
{
	$tpl->assign('title', $l->t('Failed'));
	$tpl->assign('msg', $l->t('Task \'%s\' cannot be created. Kindly try after some time.', array($_GET['title'])));
}

$tpl->printPage();
?>
