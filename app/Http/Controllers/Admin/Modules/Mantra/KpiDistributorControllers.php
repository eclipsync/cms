<?php
namespace App\Http\Controllers\Admin\Modules\Mantra;

use Incodiy\Codiy\Controllers\Core\Controller;
use App\Models\Admin\Modules\Mantra\KpiDistributor;
use App\Models\Admin\Modules\Mantra\KpiDistributorsDetail;
/**
 * Created on Oct 1, 2022
 * Time Created : 12:23:15 AM
 *
 * @filesource KpiDistributorControllers.php
 *
 * @author     eclipsync@gmail.com - 2022
 * @copyright  wisnuwidi
 * @email      eclipsync@gmail.com
 */
 
class KpiDistributorControllers extends Controller {
	public $data;
	
	private $id           = false;
	private $_set_tab     = [];
	private $_tab_config  = [];
	private $_hide_fields = ['id'];
	private $fieldset     = ['period:Periode', 'region', 'cluster', 'distributor_name', 'category', 'actual', 'target', 'percent_ach:Achv (%)', 'percent_weight:Weight (%)', 'percent_max_cap:Max Cap (%)', 'total_point'];
	
	public function __construct() {
		parent::__construct(KpiDistributor::class, 'modules.mantra');
	}
	
	public function index() {
		$this->setPage('KPI Distributors');
		
		$this->table->openTab('SUMMARY TAB');
		$this->table->setName('Summary');
		$this->table->searchable(['period', 'region', 'cluster', 'distributor_name', 'category']);
		$this->table->sortable();
		
		$this->table->filterGroups('period', 'selectbox', true);
		$this->table->filterGroups('region', 'selectbox', true);
		$this->table->filterGroups('cluster', 'selectbox', true);
		$this->table->filterGroups('distributor_name', 'selectbox', true);
		$this->table->filterGroups('category', 'selectbox');
		
		$this->table->columnCondition('actual', 'cell', '<', 1.209, 'background-color', '#F0CDCD');
		$this->table->columnCondition('actual', 'cell', '>', 1.237, 'background-color', '#F0F6FF');
		
		$this->table->formula('formula', null, ['actual', 'target'], "(actual-target)");
		
	//	$this->table->format('actual', 2);
		
		$this->table->lists($this->model_table, $this->fieldset, false);
		
		$this->table->connection('mysql_mantra');
		$this->table->openTab('DETAIL TAB');
		$this->table->setName('Detail');
	//	$this->model_table = 't_view_mantra_kpi_distributors';
	//	$this->model(KpiDistributorsDetail::class, $this->model_filters);
		$this->table->searchable(['period', 'region', 'cluster', 'distributor', 'category']);
	//	$this->table->where($this->model_filters);
		$this->table->filterConditions($this->model_filters);
		$this->table->sortable();
		$this->table->filterGroups('period', 'selectbox', true);
		$this->table->filterGroups('region', 'selectbox', true);
		$this->table->formula('formula', null, ['actual', 'target'], "(actual+target)");
		$this->table->columnCondition('actual', 'cell', '<=', 900, 'background-color', '#F0CDCD');
		$this->table->lists('t_view_mantra_kpi_distributors', [], false);
		$this->table->closeTab();
		$this->table->resetConnection();
		
		$this->table->setName('User');
		$this->table->searchable(['username', 'fullname']);
		$this->table->filterGroups('username', 'selectbox', true);
		$this->table->filterGroups('fullname', 'selectbox', true);
		$this->table->lists('users', [], false);
		
		return $this->render();
	}
}