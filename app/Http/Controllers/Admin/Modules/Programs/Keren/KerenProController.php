<?php
namespace App\Http\Controllers\Admin\Modules\Programs\Keren;

use Incodiy\Codiy\Controllers\Core\Controller;
use App\Http\Controllers\Admin\Modules\Handler;
use App\Models\Admin\Modules\Programs\Keren\KerenPro;
/**
 * Created on Mar 16, 2023
 * 
 * Time Created : 5:33:00 PM
 *
 * @filesource  KerenProController.php
 *
 * @author      wisnuwidi@gmail.com - 2023
 * @copyright   wisnuwidi@gmail.com,
 *              wisnuwidi@incodiy.com,
 *              incodiy@gmail.com
 * @email       wisnuwidi@incodiy.com
 */
class KerenProController extends Controller {
	use Handler;
	
	public $data;
	
	private $id           = false;
	private $_set_tab     = [];
	private $_tab_config  = [];
	private $_hide_fields = ['id'];
	private $fieldset_asc = [
		'period_string',
		'nama_program',
		'cor:COR',
		'region',
		'cluster',
		'sub_cluster',
		'outlet_id',
		'outlet_name:Nama Outlet',
		'program_class:Kelas Program',
		'target_revenue',
		'target_revenue_sp',
		'total_inner_revenue_with_imei',
		'total_achivement',
		'total_inner_sp_revenue_with_imei',
		'sp_achievement',
		'total_rgu_act',
		'total_inner_sp_30k',
		'total_all_revenue',
		'total_inner_revenue',
		'total_inner_sp',
		'total_inner_vd',
		'total_inner_paket_data',
		'total_inner_eligible_imei',
		'total_aktifasi',
		'hari_berjalan',
		'sisa_hari'
	];
	
	public function __construct() {
		parent::__construct(KerenPro::class, 'modules.incentive');
	}
	
	private function dateInfo($table, $connection = null) {
		return diy_date_info($table, 'period', "WHERE period IS NOT NULL", $connection);
	}
	
	public function index() {
		$this->setPage('Keren Pro');
		$this->sessionFilters();
		
		$this->removeActionButtons(['add']);
		
		$this->table->connection($this->connection);
		
		if (in_array($this->session['user_group'], array_merge(['root', $this->roleAlias])) || in_array($this->session['group_info'], ['ho'])) {
			$this->table->setCenterColumns(['cor']);
			$this->table->setRightColumns([
				'target_revenue',
				'target_revenue_sp',
				'total_inner_revenue_with_imei',
				'total_achivement',
				'total_inner_sp_revenue_with_imei',
				'sp_achievement',
				'total_rgu_act',
				'total_inner_sp_30k',
				'total_all_revenue',
				'total_inner_revenue',
				'total_inner_sp',
				'total_inner_vd',
				'total_inner_paket_data',
				'total_inner_eligible_imei',
				'total_aktifasi',
				'hari_berjalan',
				'sisa_hari'
			], true, true);
			
			$this->table->format('target_revenue', 0);
			$this->table->format('target_revenue_sp', 0);
			$this->table->format('total_inner_revenue_with_imei', 0);
			$this->table->format('total_achivement', 2);
			$this->table->format('total_inner_sp_revenue_with_imei', 0);
			$this->table->format('sp_achievement', 2);
			$this->table->format('total_inner_sp_30k', 0);
			$this->table->format('total_all_revenue', 0);
			$this->table->format('total_inner_revenue', 0);
			$this->table->format('total_inner_sp', 0);
			$this->table->format('total_inner_vd', 0);
			$this->table->format('total_inner_paket_data', 0);
			$this->table->format('total_inner_eligible_imei', 0);
			$this->table->format('total_aktifasi', 0);
			$this->table->format('hari_berjalan', 0);
			$this->table->format('sisa_hari', 0);
			
			$this->table->filterGroups('period_string', 'selectbox', true);
			$this->table->filterGroups('cor', 'selectbox', true);
			$this->table->filterGroups('region', 'selectbox', true);
			$this->table->filterGroups('cluster', 'selectbox');
			
			$this->table->clickable(false);
			$this->table->sortable();
			
			$this->table->openTab('Summary');
			$this->table->displayRowsLimitOnLoad(20);
			$this->table->searchable(['period_string', 'cor', 'region', 'cluster']);
			$this->table->label(' ');
			$this->table->addTabContent('<p>Tanggal Update Terakhir : ' . $this->dateInfo($this->model_table, $this->connection) . '</p>');
			$this->table->lists($this->model_table, $this->fieldset_asc, false);
			$this->table->clearOnLoad();
			
			$this->table->openTab('Detail');
			$this->table->displayRowsLimitOnLoad(20);
			$this->table->searchable(['period_string', 'cor', 'region', 'cluster']);
			$this->table->label(' ');
			$this->table->addTabContent('<p>Tanggal Update Terakhir : ' . $this->dateInfo('report_data_detail_program_keren_pro_national', $this->connection) . '</p>');
			$this->table->lists('report_data_detail_program_keren_pro_national', $this->fieldset_asc, false);
			$this->table->clearOnLoad();
			
			$this->table->openTab('Monthly');
			$this->table->displayRowsLimitOnLoad(20);
			$this->table->searchable(['period_string', 'cor', 'region', 'cluster']);
			$this->table->label(' ');
			$this->table->addTabContent('<p>Tanggal Update Terakhir : ' . $this->dateInfo('report_data_monthly_program_keren_pro_national', $this->connection) . '</p>');
			$this->table->lists('report_data_monthly_program_keren_pro_national', $this->fieldset_asc, false);
			$this->table->clearOnLoad();
		}
		
		if (in_array($this->session['user_group'], array_merge(['root', $this->roleAlias])) || 'outlet' === strtolower($this->session['group_info'])) {
    		$this->table->openTab('Summary Outlet');
    		$this->table->displayRowsLimitOnLoad(20);
    		$this->table->searchable(['period_string', 'cor', 'region', 'cluster']);
    		$this->table->label(' ');
    		$this->table->addTabContent('<p>Tanggal Update Terakhir : ' . $this->dateInfo('report_data_summary_program_keren_pro_outlets', $this->connection) . '</p>');
    		$this->table->lists('report_data_summary_program_keren_pro_outlets', $this->fieldset_asc, false);
    		$this->table->clearOnLoad();
		}
		$this->table->closeTab();
		
		return $this->render();
	}
}