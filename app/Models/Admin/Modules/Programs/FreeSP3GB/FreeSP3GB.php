<?php
namespace App\Models\Admin\Modules\Programs\FreeSP3GB;

use Incodiy\Codiy\Models\Core\Model;
/**
 * Created on May 18, 2023
 * 
 * Time Created : 10:43:18 PM
 *
 * @filesource  FreeSP3GB.php
 *
 * @author      wisnuwidi@gmail.com - 2023
 * @copyright   wisnuwidi@gmail.com,
 *              incodiy@gmail.com
 * @email       wisnuwidi@gmail.com,
 *              incodiy@gmail.com
 */
class FreeSP3GB extends Model {
    protected $connection = 'mysql_mantra_etl';
    protected $table	  = 'report_data_summary_program_free_sp_3gb';
    protected $guarded    = [];
    
    public function getConnectionName() {
        return $this->connection;
    }
}