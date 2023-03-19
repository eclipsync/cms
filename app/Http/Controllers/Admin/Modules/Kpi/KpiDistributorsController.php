<?php
namespace App\Http\Controllers\Admin\Modules\Kpi;

use Incodiy\Codiy\Controllers\Core\Controller;
use App\Http\Controllers\Admin\Modules\Handler;
use App\Models\Admin\Modules\Kpi\KpiDistributors;
/**
 * Created on 19 Mar 2023
 * 
 * Time Created : 00:18:01
 *
 * @filesource  KpiDistributorsController.php
 *
 * @author      wisnuwidi@gmail.com - 2023
 * @copyright   wisnuwidi@gmail.com,
 *              incodiy@gmail.com
 * @email       wisnuwidi@gmail.com
 */

class KpiDistributorsController extends Controller {
    use Handler;
    
    public $data;
    
    private $id           = false;
    private $_set_tab     = [];
    private $_tab_config  = [];
    private $_hide_fields = ['id'];
    private $fieldset_asc = [];
    
    public function __construct() {
        parent::__construct(KpiDistributors::class, 'modules.kpi');
    }
    
    private function dateInfo($table, $connection = null) {
        return diy_date_info($table, 'running_date', "WHERE period IS NOT NULL", $connection);
    }
    
    public function index() {
        $this->setPage('Incentive ASC');
        $this->sessionFilters();
        
        $this->removeActionButtons(['add']);
        
        $this->table->connection($this->connection);
        $this->table->setCenterColumns(['cor']);
        $this->table->setRightColumns([], true, true);
        
        $this->table->format('tgtpo', 0);
        $this->table->format('achpo', 2);
        
        $this->table->filterGroups('period_string', 'selectbox', true);
        $this->table->filterGroups('cor', 'selectbox', true);
        $this->table->filterGroups('region', 'selectbox', true);
        $this->table->filterGroups('cluster', 'selectbox');
        
        $this->table->clickable(false);
        $this->table->sortable();
        
        $this->table->openTab('Summary');
        $this->table->searchable(['period_string', 'cor', 'region', 'cluster']);
        $this->table->label(' ');
        $this->table->addTabContent('<p>Tanggal Update Terakhir : ' . $this->dateInfo($this->model_table, $this->connection) . '</p>');
        
        $this->table->displayRowsLimitOnLoad('*');
        $this->table->lists($this->model_table, $this->fieldset_asc, false);
        $this->table->clearOnLoad();
        
        $this->table->closeTab();
        
        return $this->render();
    }
}