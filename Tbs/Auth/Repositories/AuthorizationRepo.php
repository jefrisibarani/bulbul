<?php
/**
 * @author jefrisibarani@gmail.com
 */

namespace Tbs\Auth\Repositories;

class AuthorizationRepo implements AuthorizationRepoInterface
{
   public function __construct()
   {
   }

   public function getUserPermission(int $userId)
   {
      return [];
   }

   public function getRolePermission(int $roleId)
   {
      return [];
   }
}