<?php
/**
 * @author jefrisibarani@gmail.com
 */

namespace Tbs\Auth\Authentication;

interface AuthenticatorInterface
{
   public function login(array $credentials, &$feedback=null, bool $remember=false) : bool;

   public function isLoggedIn() : bool;

   public function identity();

   public function logout();
}
