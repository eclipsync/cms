<?php
namespace App\Http\Controllers\Admin\Modules;
/**
 * Created on 15 Mar 2023
 * 
 * Time Created : 22:12:52
 *
 * @filesource  Handler.php
 *
 * @author      wisnuwidi@gmail.com - 2023
 * @copyright   wisnuwidi@gmail.com,
 *              incodiy@gmail.com
 * @email       wisnuwidi@gmail.com
 */

trait Handler {
    private $roleAlias = ['admin', 'internal'];
    private $roleInfo  = ['National'];
    
    private function sessionFilters() {
    	$user_session_alias = diy_config('user.alias_session_name');
    	if ('root' !== $this->session['user_group']) {
    		if (!in_array($this->session['user_group'], $this->roleAlias) && !in_array($this->session['group_alias'], $this->roleInfo)) {
    			if ('outlet' === strtolower($this->session['group_info'])) {
    				$this->filterPage(['outlet_id' => strtolower($this->session['username'])], '=');
    			} else {
    				$this->filterPage(['region' => $this->session['group_alias']], '=');
    			}
    			if (!empty($this->session[$user_session_alias])) {
    				foreach ($this->session[$user_session_alias] as $fieldset => $fieldvalues) {
    					$this->filterPage([$fieldset => $fieldvalues], '=');
    				}
    			}
    		}
    	}
    }
}