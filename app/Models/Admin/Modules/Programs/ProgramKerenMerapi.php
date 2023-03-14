<?php
namespace App\Models\Admin\Modules\Programs;

use Incodiy\Codiy\Models\Core\Model;
/**
 * Created on 19 Feb 2023
 * 
 * Time Created : 20:31:18
 *
 * @filesource  ProgramKerenMerapi.php
 *
 * @author      wisnuwidi@gmail.com - 2023
 * @copyright   wisnuwidi@gmail.com,
 *              incodiy@gmail.com
 * @email       wisnuwidi@gmail.com
 */
class ProgramKerenMerapi extends Model {
    protected $connection = 'mysql_mantra_etl';
    protected $table      = 'view_report_data_summary_program_keren_merapi';
    protected $tableView  = true;
    protected $guarded    = [];
    
    public function getConnectionName() {
        return $this->connection;
    }
}