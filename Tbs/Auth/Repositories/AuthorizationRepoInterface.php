<?php
/**
 * @author jefrisibarani@gmail.com
 */

namespace Tbs\Auth\Repositories;

interface AuthorizationRepoInterface
{
   public function getUserPermission(int $userId);
   public function getRolePermission(int $roleId);
}