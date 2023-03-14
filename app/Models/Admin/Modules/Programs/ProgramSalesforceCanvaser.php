<?php
namespace App\Models\Admin\Modules\Programs;

use Incodiy\Codiy\Models\Core\Model;
/**
 * Created on 19 Feb 2023
 * 
 * Time Created : 22:28:31
 *
 * @filesource  ProgramSalesforceCanvaser.php
 *
 * @author      wisnuwidi@gmail.com - 2023
 * @copyright   wisnuwidi@gmail.com,
 *              incodiy@gmail.com
 * @email       wisnuwidi@gmail.com
 */
class ProgramSalesforceCanvaser extends Model {
    protected $connection = 'mysql_mantra_etl';
    protected $table      = 'view_report_data_summary_salesforce_canvaser';
    protected $tableView  = true;
    protected $guarded    = [];
    
    public function getConnectionName() {
        return $this->connection;
    }
}