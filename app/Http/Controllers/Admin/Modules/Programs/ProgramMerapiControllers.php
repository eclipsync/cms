<?php
namespace App\Http\Controllers\Admin\Modules\Programs;

use Incodiy\Codiy\Controllers\Core\Controller;
use App\Models\Admin\Modules\Programs\ProgramMerapi;
use App\Http\Controllers\Admin\Modules\Handler;
/**
 * Created on Nov 30, 2022
 * 
 * Time Created : 10:12:00 AM
 *
 * @filesource	ProgramMerapiControllers.php
 *
 * @author     wisnuwidi@gmail.com - 2022
 * @copyright  wisnuwidi
 * @email      wisnuwidi@gmail.com
 */
class ProgramMerapiControllers extends Controller {
    use Handler;
    
	public  $data;
	private $fields = [
	    'period_string:Period',
	    'program_name',
	    'cor',
	    'region',
	    'cluster',
	    'sub_cluster',
	    'outlet_id',
	    'outlet_name',
	    'total_all_revenue',
	    'total_eligible_revenue',
	    'total_sp_new_imei_revenue',
	    'revenue_sp_inner',
	    'revenue_vd_inner',
	    'total_eligible_ipp_purchase',
	    'class_outlet_program',
	    'status_class_outlet_program'
	];
	
	public function __construct() {
		parent::__construct(ProgramMerapi::class, 'modules.programs.program_keren');
	}
	
	private function dateInfo($table, $connection = null) {
	    return diy_date_info($table, 'update_data', null, $connection);
	}
	
	public function index() {
	    $this->setPage('Program Merapi');
	    $this->sessionFilters();
		
		$this->removeActionButtons(['add']);
		
		$this->table->connection($this->connection);
		
		$this->table->setCenterColumns(['program_name', 'cor', 'status_class_outlet_program']);
		$this->table->setRightColumns([
		    'total_all_revenue',
		    'total_eligible_revenue',
		    'total_sp_new_imei_revenue',
		    'revenue_sp_inner',
		    'revenue_vd_inner',
		    'total_eligible_ipp_purchase'
		]);
		
		$this->table->format('total_all_revenue', 2);
		$this->table->format('total_eligible_revenue', 2);
		$this->table->format('total_sp_new_imei_revenue', 2);
		$this->table->format('revenue_sp_inner', 2);
		$this->table->format('revenue_vd_inner', 2);
		$this->table->format('total_eligible_ipp_purchase', 2);
		
		$this->table->openTab('Summary');
		$this->table->label(' ');
		$this->table->addTabContent('<p>Tanggal Update Terakhir : ' . $this->dateInfo('report_data_summary_program_merapi', $this->connection) . '</p>');
		$this->table->searchable(['period_string', 'program_name', 'region', 'cluster']);
		$this->table->clickable(false);
		$this->table->sortable();
		
		$this->table->filterGroups('period_string', 'selectbox', true);
		$this->table->filterGroups('program_name', 'selectbox', true);
		$this->table->filterGroups('cor', 'selectbox', true);
		$this->table->filterGroups('region', 'selectbox', true);
		$this->table->filterGroups('cluster', 'selectbox');
		
		$this->table->lists($this->model_table, $this->fields, false);
		
		$this->table->openTab('Monthly');
		$this->table->label(' ');
		$this->table->addTabContent('<p>Tanggal Update Terakhir : ' . $this->dateInfo('report_data_monthly_program_merapi', $this->connection) . '</p>');
		$this->table->searchable(['period_string', 'program_name', 'region', 'cluster']);
		$this->table->clickable(false);
		$this->table->sortable();
		
		$this->table->filterGroups('period_string', 'selectbox', true);
		$this->table->filterGroups('program_name', 'selectbox', true);
		$this->table->filterGroups('cor', 'selectbox', true);
		$this->table->filterGroups('region', 'selectbox', true);
		$this->table->filterGroups('cluster', 'selectbox');
		
		$this->table->lists('view_report_data_monthly_program_merapi', $this->fields, false);
		
		$this->table->closeTab();
		
		return $this->render();
	}
}