<?php

namespace MMO\Cakeday\XF\Entity;

class User extends XFCP_User
{
    public function hasCakeday(&$error = null)
    {
        list($sDay, $sMonth, $sYear, $isLeap) = explode('/', date('j/n/Y/L', \XF::$time));
        list($uDay, $uMonth, $uYear) = explode('/', date('j/n/Y', $this->register_date));

        if (!$isLeap && $uMonth == 2 && $uDay == 29)
        {
            $uDay = 28;
        }

		return ($sDay == $uDay && $sMonth == $uMonth && $sYear != $uYear);
	}
}