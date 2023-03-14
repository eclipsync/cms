<?php
namespace App\Models\Admin\Modules\Programs;

use Incodiy\Codiy\Models\Core\Model;
/**
 * Created on Nov 29, 2022
 * 
 * Time Created : 11:28:28 AM
 *
 * @filesource	ProgramKeren.php
 *
 * @author     wisnuwidi@gmail.com - 2022
 * @copyright  wisnuwidi
 * @email      wisnuwidi@gmail.com
 */
class ProgramKeren extends Model {
	protected $connection = 'mysql_mantra_etl';
	protected $table	    = 'report_data_summary_program_keren';
	protected $guarded    = [];
	
	public function getConnectionName() {
		return $this->connection;
	}
}