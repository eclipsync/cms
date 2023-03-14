<?php
namespace App\Models\Admin\Modules\Programs;

use Incodiy\Codiy\Models\Core\Model;

/**
 * Created on Nov 30, 2022
 * 
 * Time Created : 10:13:15 AM
 *
 * @filesource	ProgramMerapi.php
 *
 * @author     wisnuwidi@gmail.com - 2022
 * @copyright  wisnuwidi
 * @email      wisnuwidi@gmail.com
 */
class ProgramMerapi extends Model {
	protected $connection = 'mysql_mantra_etl';
	protected $table      = 'view_report_data_summary_program_merapi';
	protected $tableView  = true;
	protected $guarded    = [];
	
	public function getConnectionName() {
		return $this->connection;
	}
}