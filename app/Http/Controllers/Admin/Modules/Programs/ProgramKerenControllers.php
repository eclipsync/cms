<?php
namespace App\Http\Controllers\Admin\Modules\Programs;

use Incodiy\Codiy\Controllers\Core\Controller;
use App\Models\Admin\Modules\Programs\ProgramKeren;
/**
 * Created on Nov 29, 2022
 * 
 * Time Created : 11:25:30 AM
 *
 * @filesource	ProgramKerenControllers.php
 *
 * @author     wisnuwidi@gmail.com - 2022
 * @copyright  wisnuwidi
 * @email      wisnuwidi@gmail.com
 */
class ProgramKerenControllers extends Controller {
	public  $data;
	
	private $fieldset_summary = [
		'period_string:Periode',
		'program_name:Nama Program',
		'cor:COR',
		'region:Region',
		'cluster:Cluster',
		'sub_cluster:Sub Cluster',
		'outlet_id:Outlet Induk',
		'outlet_name:Nama Outlet',
		'program_level:Kelas Program',
		'total_all_revenue:Total Revenue',
		'total_eligible_revenue:Total Revenue Inner',
		'total_eligible_revenue_sp_new_imei:Revenue SP New IMEI Inner',
		'total_eligible_revenue_sp:Revenue SP Inner',
		'total_eligible_revenue_vd:Revenue VD Inner',
		'total_eligible_revenue_ipp:Revenue Paket Data Inner',
		'daily_avg_eligible_revenue:Rata2 Harian revenue Inner',
		'next_level_gap:Selisih ke Kelas Selanjutnya',
		'next_level_program:Kelas Selanjutnya',
		'days_ongoing:Hari Berjalan',
		'days_remaining:Sisa Hari'
	];
	
	private $fieldset_detail  = [
		'period_string:Periode',
		'program_name:Nama Program',
		'cor:COR',
		'region:Region',
		'cluster:Cluster',
		'sub_cluster:Sub Cluster',
		'outlet_bandar:Outlet Induk',
		'outlet_id:Outlet Cabang',
		'outlet_name:Nama Outlet',
		'program_level:Kelas Program',
		'total_all_revenue:Total Revenue',
		'total_eligible_revenue:Total Revenue Inner',
		'total_sp_eligible_imei_revenue:Revenue SP New IMEI Inner',
		
		'revenue_sp_inner',
		'total_eligible_sp_preload',
		'total_eligible_sp_cocktail',
		
		'revenue_vd_inner',
		'total_eligible_vd_preload',
		'total_eligible_vd_cocktail',
		
		'total_eligible_ipp_purchase:Revenue Paket Data Inner',
		
		'total_aktivasi_sp',
		'qty_activation_sp_preload',
		'qty_activation_sp_cocktail',
		
		'total_aktivasi_sp_inner',
		'qty_eligible_sp_preload',
		'qty_eligible_sp_cocktail',
		
		'daily_avg_eligible_revenue:Rata-rata Harian Revenue Inner',
		'next_level_gap:Selisih ke Kelas Selanjutnya',
		'next_level_program:Kelas Selanjutnya',
		'days_ongoing:Hari Berjalan',
		'days_remaining:Sisa Hari'
	];
	
	private $fieldset_monthly = [
		'period_string:Periode',
		'program_name:Nama Program',
		'cor:COR',
		'region:Region',
		'cluster:Cluster',
		'sub_cluster:Sub Cluster',
		'outlet_bandar:Outlet Induk',
		'outlet_id:Outlet Cabang',
		'outlet_name:Nama Outlet',
		'program_level:Kelas Program',
		'total_all_revenue:Total Revenue',
		'total_eligible_revenue:Total Revenue Inner',
		'total_sp_new_imei_revenue:Revenue SP New IMEI Inner',
		
		'revenue_sp_inner',
		'total_eligible_sp_preload',
		'total_eligible_sp_cocktail',
		
		'revenue_vd_inner',
		'total_eligible_vd_preload',
		'total_eligible_vd_cocktail',
		
		'total_eligible_ipp_purchase:Revenue Paket Data Inner',
		
		'total_aktifasi_sp',
		'qty_activation_sp_preload',
		'qty_activation_sp_cocktail',
		
		'total_aktifasi_sp_inner',
		'qty_eligible_sp_preload',
		'qty_eligible_sp_cocktail',
		
		'daily_avg_eligible_revenue_cum:Rata2 Harian revenue Inner',
		
		'next_level_gap:Selisih ke kelas selanjutnya',
		'next_level_program:Kelas Selanjutnya',
		'days_ongoing:Hari Berjalan',
		'days_remaining:Sisa Hari'
	];
	
	public function __construct() {
		parent::__construct(ProgramKeren::class, 'modules.programs.program_merapi');
	}
	
	private function dateInfo($table, $connection = null) {
		return diy_date_info($table, 'insert_date', "WHERE program_name = 'KEREN'", $connection);
	}
	
	private function sessionFilters() {
	    if ('root' !== $this->session['user_group']) {
	        if ('outlet' === strtolower($this->session['group_info'])) {
	            $this->filterPage(['outlet_id' => strtolower($this->session['group_alias'])], '=');
	        } else {
	            if ('national' !== strtolower($this->session['group_alias'])) {
	                $this->filterPage(['region' => $this->session['group_alias']], '=');
	            }
	        }
	    }
	}
	
	public function index() {
		$this->setPage('Program Keren');
		$this->sessionFilters();
		
		$this->removeActionButtons(['add']);
		
		$this->table->connection($this->connection);
		
		$this->table->setCenterColumns(['cor']);
		$this->table->setRightColumns([
			'total_all_revenue', 
			'total_eligible_revenue', 
			'total_eligible_revenue_sp_new_imei', 
			'total_eligible_revenue_sp', 
			'total_eligible_revenue_vd',
			'total_eligible_revenue_ipp',
			
			'total_sp_eligible_imei_revenue',
			'revenue_sp_inner',
			'revenue_vd_inner',
			'total_eligible_ipp_purchase',
			'total_aktivasi_sp',
			'total_aktivasi_sp_inner',
			
			'total_sp_new_imei_revenue',
			'daily_avg_eligible_revenue_cum',
			
			'daily_avg_eligible_revenue',
			'next_level_gap',
			'days_ongoing',
			'days_remaining'
		], true, true);
		
		$this->table->format('total_all_revenue', 2);
		$this->table->format('total_eligible_revenue', 2);
		$this->table->format('total_eligible_revenue_sp_new_imei', 2);
		$this->table->format('total_eligible_revenue_sp', 2);
		$this->table->format('total_eligible_revenue_vd', 2);
		$this->table->format('total_eligible_revenue_ipp', 2);
		
		$this->table->format('total_sp_eligible_imei_revenue', 2);
		$this->table->format('total_eligible_ipp_purchase', 2);
		$this->table->format('total_sp_new_imei_revenue', 2);
		$this->table->format('daily_avg_eligible_revenue_cum', 2);
		
		$this->table->format('daily_avg_eligible_revenue', 2);
		$this->table->format('next_level_gap', 2);
		
		$this->table->filterGroups('period_string', 'selectbox', true);
		$this->table->filterGroups('program_name', 'selectbox', true);
		$this->table->filterGroups('cor', 'selectbox', true);
		$this->table->filterGroups('region', 'selectbox', true);
		$this->table->filterGroups('cluster', 'selectbox');
		
		$this->table->clickable(false);
		$this->table->sortable();
		
		$this->table->openTab('Summary');
		$this->table->searchable(['period_string', 'program_name', 'cor', 'region', 'cluster']);
		$this->table->label(' ');
		$this->table->addTabContent('<p>Tanggal Update Terakhir : ' . $this->dateInfo('report_data_summary_program_keren', $this->connection) . '</p>');
		$this->table->lists($this->model_table, $this->fieldset_summary, false);
		
		$this->table->openTab('Detail');
	//	$this->table->searchable(['period_string', 'program_name', 'cor', 'region']);
		$this->table->label(' ');
		$this->table->setHiddenColumns([
			'total_eligible_sp_preload', 
			'total_eligible_sp_cocktail', 
			'total_eligible_vd_preload', 
			'total_eligible_vd_cocktail', 
			'qty_activation_sp_preload', 
			'qty_activation_sp_cocktail', 
			'qty_eligible_sp_preload', 
			'qty_eligible_sp_cocktail'
		]);
		$this->table->formula('revenue_sp_inner', null, ['total_eligible_sp_preload', 'total_eligible_sp_cocktail'], "(total_eligible_sp_preload+total_eligible_sp_cocktail)");
		$this->table->formula('revenue_vd_inner', null, ['total_eligible_vd_preload', 'total_eligible_vd_cocktail'], "(total_eligible_vd_preload+total_eligible_vd_cocktail)");
		$this->table->formula('total_aktivasi_sp', null, ['qty_activation_sp_preload', 'qty_activation_sp_cocktail'], "(qty_activation_sp_preload+qty_activation_sp_cocktail)");
		$this->table->formula('total_aktivasi_sp_inner', null, ['qty_eligible_sp_preload', 'qty_eligible_sp_cocktail'], "(qty_eligible_sp_preload+qty_eligible_sp_cocktail)");
		$this->table->addTabContent('<p>Tanggal Update Terakhir : ' . $this->dateInfo('report_data_detail_program_keren', $this->connection) . '</p>');
		$this->table->lists('report_data_detail_program_keren', $this->fieldset_detail, false);
		
		if ('outlet' !== strtolower($this->session['group_info'])) {
    		$this->table->openTab('Monthly');
    	//	$this->table->searchable(['period_string', 'program_name', 'region', 'cluster']);
    		$this->table->label(' ');
    		$this->table->setHiddenColumns([
    			'total_eligible_sp_preload',
    			'total_eligible_sp_cocktail',
    			'total_eligible_vd_preload',
    			'total_eligible_vd_cocktail',
    			'qty_activation_sp_preload',
    			'qty_activation_sp_cocktail',
    			'qty_eligible_sp_preload',
    			'qty_eligible_sp_cocktail'
    		]);
    		$this->table->formula('revenue_sp_inner', null, ['total_eligible_sp_preload', 'total_eligible_sp_cocktail'], "(total_eligible_sp_preload+total_eligible_sp_cocktail)");
    		$this->table->formula('revenue_vd_inner', null, ['total_eligible_vd_preload', 'total_eligible_vd_cocktail'], "(total_eligible_vd_preload+total_eligible_vd_cocktail)");
    		$this->table->formula('total_aktivasi_sp', null, ['qty_activation_sp_preload', 'qty_activation_sp_cocktail'], "(qty_activation_sp_preload+qty_activation_sp_cocktail)");
    		$this->table->formula('total_aktivasi_sp_inner', null, ['qty_eligible_sp_preload', 'qty_eligible_sp_cocktail'], "(qty_eligible_sp_preload+qty_eligible_sp_cocktail)");
    		$this->table->addTabContent('<p>Tanggal Update Terakhir : ' . $this->dateInfo('report_data_monthly_program_keren', $this->connection) . '</p>');
    		$this->table->lists('report_data_monthly_program_keren', $this->fieldset_monthly, false);
		}
		$this->table->closeTab();
		
		return $this->render();
	}
}