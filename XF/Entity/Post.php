<?php

namespace MMO\Cakeday\XF\Entity;

class Post extends XFCP_Post
{
	public function canViewCakeday(&$error = null)
	{
		$thread = $this->Thread;
		$visitor = \XF::visitor();
		if (!$visitor->user_id || !$thread)
		{
			return false;
		}
		
		$nodeId = $thread->node_id;
		
		if ($visitor->hasNodePermission($nodeId, 'viewCakeday') && $this->User->hasNodePermission($nodeId, 'displayOwnCakeday'))
		{
			return true;
		}

		return false;
	}

	public function hasCakeday(&$error = null)
	{
		if (!$this->User)
		{
			return false;
		}

		list($pDay, $pMonth, $pYear, $isLeap) = explode('/', date('j/n/Y/L', $this->post_date));
		list($uDay, $uMonth, $uYear) = explode('/', date('j/n/Y', $this->User->register_date));

		if (!$isLeap && $uMonth == 2 && $uDay == 29)
		{
			$uDay = 28;
		}

		return ($pDay == $uDay && $pMonth == $uMonth && $pYear != $uYear);
	}
}