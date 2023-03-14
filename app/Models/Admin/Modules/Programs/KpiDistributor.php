<?php
namespace App\Models\Admin\Modules\Programs;

use Incodiy\Codiy\Models\Core\Model;
/**
 * Created on 25 Feb 2023
 * 
 * Time Created : 01:26:15
 *
 * @filesource  KpiDistributor.php
 *
 * @author      wisnuwidi@gmail.com - 2023
 * @copyright   wisnuwidi@gmail.com,
 *              incodiy@gmail.com
 * @email       wisnuwidi@gmail.com
 */
class KpiDistributor extends Model {
    protected $connection = 'mysql_mantra_etl';
    protected $table      = 'view_report_data_summary_program_kpi_distributors';
    protected $tableView  = true;
    protected $guarded    = [];
    
    public function getConnectionName() {
        return $this->connection;
    }
}