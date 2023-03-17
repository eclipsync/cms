<?php
namespace App\Http\Controllers\Admin\Modules\Kpi;

use Incodiy\Codiy\Controllers\Core\Controller;
use App\Models\Admin\Modules\Kpi\KpiDistributor;
use App\Http\Controllers\Admin\Modules\Handler;
/**
 * Created on Mar 2, 2023
 * 
 * Time Created : 10:52:00 AM
 *
 * @filesource  KpiDistributorController.php
 *
 * @author      wisnuwidi@gmail.com - 2023
 * @copyright   wisnuwidi@gmail.com,
 *              incodiy@gmail.com
 * @email       wisnuwidi@gmail.com
 */
class KpiDistributorController extends Controller {
    use Handler;
    
	public  $data;
	private $fields = [
		'period',
		'period_string',
		'period_bts',
		'period_bts_string',
		'region',
		'cluster',
		'category',
		'distributor_name',
		'actual',
		'target',
		'percent_ach',
		'percent_weight',
		'max_cap',
		'total_point'
	];
	
	public function __construct() {
		parent::__construct(KpiDistributor::class, 'modules.kpi.distributors');
	}
	
	private function dateInfo($table, $connection = null) {
		return diy_date_info($table, 'period', null, $connection);
	}
	
	public function index() {
		$this->setPage('Program KPI Distributor');
		$this->sessionFilters();
		
		$this->removeActionButtons(['add']);
		
		$this->table->connection($this->connection);
		$this->table->setCenterColumns(['period_string', 'region', 'cluster', 'category']);
		$this->table->setRightColumns([
			'actual',
			'target',
			'percent_ach',
			'percent_weight',
			'max_cap',
			'total_point'
		]);
		$this->table->format('actual', 2);
		$this->table->format('target', 2);
		$this->table->format('percent_ach', 2);
		$this->table->format('percent_weight', 2);
		$this->table->format('max_cap', 2);
		$this->table->format('total_point', 2);
		
		$this->table->label(' ');
		$this->table->addTabContent('<p>Tanggal Update Terakhir : ' . $this->dateInfo($this->model_table, $this->connection) . '</p>');
		$this->table->searchable(['period_string', 'region', 'cluster', 'category']);
		$this->table->clickable(false);
		$this->table->sortable();
		
		$this->table->filterGroups('period_string', 'selectbox', true);
		$this->table->filterGroups('region', 'selectbox', true);
		$this->table->filterGroups('cluster', 'selectbox', true);
		$this->table->filterGroups('category', 'selectbox', true);
		
		$this->table->lists($this->model_table, $this->fields, false);
		
		return $this->render();
	}
}