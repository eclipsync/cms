<?php
namespace App\Http\Controllers\Admin\Modules\Programs\Fit;

use Incodiy\Codiy\Controllers\Core\Controller;
use App\Models\Admin\Modules\Programs\Fit\FitPro;
use App\Http\Controllers\Admin\Modules\Handler;
/**
 * Created on 19 Mar 2023
 * 
 * Time Created : 18:36:04
 *
 * @filesource  FitProController.php
 *
 * @author      wisnuwidi@gmail.com - 2023
 * @copyright   wisnuwidi@gmail.com,
 *              incodiy@gmail.com
 * @email       wisnuwidi@gmail.com
 */
class FitProController extends Controller {
    use Handler;
    
    public  $data;
    private $fieldSets = [
        'period_string',
        'cor:COR',
        'region',
        'cluster',
        'sub_cluster',
        'outlet_id',
        'outlet_name',
        'act_total',
        'act_new_imei',
        'act_old_imei',
        'act_no_imei',
        'act_by_sgs',
        'act_by_non_sgs',
        'act_by_sgs_new_imei',
        'act_by_non_sgs_new_imei',
        'reward',
        'add_act_new_imei',
        'reward_extra',
        'total_reward',
        'reward_month_90_days',
        'mdn_active_90_days:MDN Active 90 Days',
        'reward_extra_2'
    ];
    
    public function __construct() {
        parent::__construct(FitPro::class, 'modules.programs.program_fit_pro');
    }
    
    private function dateInfo($table, $connection = null) {
        return diy_date_info($table, 'period', "WHERE period IS NOT NULL", $connection);
    }
    
    public function index() {
        $this->setPage('Program FIT Pro');
        $this->sessionFilters();
        
        $this->removeActionButtons(['add']);
        
        $this->table->connection($this->connection);
        
        if (in_array($this->session['user_group'], array_merge(['root', $this->roleAlias])) || in_array($this->session['group_alias'], ['National'])) {
            $this->table->openTab('Summary');
            
            $this->table->displayRowsLimitOnLoad(20);
            $this->table->setRightColumns(['act_fit_point']);
            
            $this->table->label(' ');
            if (!empty($this->dateInfo($this->model_table, $this->connection))) {
                $this->table->addTabContent('<p>Tanggal Update Terakhir : ' . $this->dateInfo($this->model_table, $this->connection) . '</p>');
            }
            $this->table->searchable(['period_string', 'cor', 'region', 'cluster']);
            $this->table->clickable(false);
            $this->table->sortable();
            
            $this->table->filterGroups('period_string', 'selectbox', true);
            $this->table->filterGroups('cor', 'selectbox', true);
            $this->table->filterGroups('region', 'selectbox', true);
            $this->table->filterGroups('cluster', 'selectbox', true);
            
            $this->table->lists($this->model_table, $this->fieldSets, false);
            
            $this->table->closeTab();
            $this->table->clearOnLoad();
        }
        return $this->render();
    }
}