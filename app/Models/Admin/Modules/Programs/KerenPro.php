<?php
namespace App\Models\Admin\Modules\Programs;

use Incodiy\Codiy\Models\Core\Model;
/**
 * Created on Mar 16, 2023
 * 
 * Time Created : 5:33:24 PM
 *
 * @filesource  KerenPro.php
 *
 * @author      wisnuwidi@gmail.com - 2023
 * @copyright   wisnuwidi@gmail.com,
 *              incodiy@gmail.com
 * @email       wisnuwidi@gmail.com
 */
class KerenPro extends Model {
	protected $connection = 'mysql_mantra_etl';
	protected $table	  = 'report_data_summary_program_keren_pro_national';
	protected $guarded    = [];
	
	public function getConnectionName() {
		return $this->connection;
	}
}