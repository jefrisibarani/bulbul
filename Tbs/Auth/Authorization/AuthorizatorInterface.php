<?php
/**
 * @author jefrisibarani@gmail.com
 */

namespace Tbs\Auth\Authorization;

interface AuthorizatorInterface
{
   public function canAccess($user, $menuId) : bool;
   public function hasPermission($user, $permission) : bool;
}
