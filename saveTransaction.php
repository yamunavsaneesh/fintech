<?php

/**
 * Save Transaction
 *
 * @category Configuration
 * @package config file
 * @author YamunaV<mail2yamunav@gmail.com> 
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link   http://www.myapplication.com/
 */
include 'config.php';
require 'Classes/Accounts.php';
$objAccount = new Accounts();
$post_fileds = [];
if ($post = $_POST) {
    foreach ($post as $key =>  $val) :
        $post_fileds[$key] = htmlspecialchars($val);
    endforeach;
      $accounts = $objAccount->saveTransaction($post_fileds); 
}
header('Location:transactions.php');