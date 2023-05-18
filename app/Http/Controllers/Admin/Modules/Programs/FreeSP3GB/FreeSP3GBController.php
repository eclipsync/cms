<?php
namespace App\Http\Controllers\Admin\Modules\Programs\FreeSP3GB;

use Incodiy\Codiy\Controllers\Core\Controller;
use Incodiy\Codiy\Controllers\Core\Craft\Handler;
use App\Models\Admin\Modules\Programs\FreeSP3GB\FreeSP3GB;

/**
 * Created on May 18, 2023
 * 
 * Time Created : 10:40:02 PM
 *
 * @filesource  FreeSP3GBController.php
 *
 * @author      wisnuwidi@gmail.com - 2023
 * @copyright   wisnuwidi@gmail.com,
 *              incodiy@gmail.com
 * @email       wisnuwidi@gmail.com,
 *              incodiy@gmail.com
 */
class FreeSP3GBController extends Controller {
    use Handler;
    
    private $fields = [
        'distributor_name',
        'region',
        'cluster',
        'sub_cluster',
        'target:Target Free SP',
        'act_usage:ACT Usage',
        'ach_target:Usage BTS Most<br />ACT Target',
        'act_usage_imei:ACT Usage IMEI',
        'ach_usage_imei:% Usage IMEI'
    ];
    
    public function __construct() {
        parent::__construct(FreeSP3GB::class, 'modules.programs.freesp3gb');
    }
    
    private function dateInfo($table, $connection = null) {
        return diy_date_info($table, 'period', "WHERE period IS NOT NULL", $connection);
    }
    
    private function startDateInfo($table, $connection = null) {
        return diy_date_info($table, 'update_date', "WHERE update_date IS NOT NULL", $connection);
    }
    
    public function index() {
        $this->setPage('Program Free SP 3GB');
        $this->sessionFilters();
        
        $this->removeActionButtons(['add']);
        
        $this->table->connection($this->connection);
        
        if (in_array($this->session['user_group'], array_merge(['root', $this->roleAlias])) || 'outlet' !== strtolower($this->session['group_info'])) {
            $this->table->mergeColumns('Activation NEW IMEI<br />( BTS Most Usage D+7)', ['act_usage_imei', 'ach_usage_imei']);
            $this->table->setCenterColumns(['program_name', 'cor', 'outlet_id']);
            $this->table->setRightColumns([            
                'act_usage',
                'ach_target',
                'act_usage_imei',
                'ach_usage_imei'
            ]);
            $this->table->format('ach_target', 2);
            $this->table->format('ach_usage_imei', 2);
            $this->table->columnCondition('ach_usage_imei', 'cell', '>=', 1, 'suffix', ' %');
            
            $this->table->label(' ');
            $this->table->addTabContent('<p>Start Program : ' . $this->dateInfo($this->model_table, $this->connection) . '</p>');
            $this->table->addTabContent('<p>Update Date : ' . $this->startDateInfo($this->model_table, $this->connection) . '</p>');
            $this->table->searchable(['period_string', 'region', 'cluster', 'distributor_name']);
            $this->table->clickable(false);
            $this->table->sortable();
            
            $this->table->filterGroups('period_string', 'selectbox', true);
            $this->table->filterGroups('region', 'selectbox', true);
            $this->table->filterGroups('cluster', 'selectbox', true);
            $this->table->filterGroups('distributor_name', 'selectbox', true);
            
            $this->table->lists($this->model_table, $this->fields, false);
        }
        
        return $this->render();
    }
}