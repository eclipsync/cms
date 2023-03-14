<?php
namespace App\Http\Controllers\Admin\Modules\Programs;

use Incodiy\Codiy\Controllers\Core\Controller;
use App\Models\Admin\Modules\Programs\ProgramNatunaAnambas;
/**
 * Created on Feb 20, 2023
 * 
 * Time Created : 4:41:59 PM
 *
 * @filesource  ProgramNatunaAnambasControllers.php
 *
 * @author      wisnuwidi@gmail.com - 2023
 * @copyright   wisnuwidi@gmail.com,
 *              incodiy@gmail.com
 * @email       wisnuwidi@gmail.com
 */
class ProgramNatunaAnambasControllers extends Controller {
	public  $data;
	private $fieldSummary = [
		'period',
		'period_string',
		'product_name',
		'destination',
		'allocation',
		'activation',
		'rgu',
		'imei_flag'
	];
	
	private $fieldDetail = [
		'period',
		'period_string',
		'activation_date',
		'destination',
		'bts_province',
		'bts_city',
		'bts_name',
		'bts_code',
		'mdn',
		'product_name',
		'ship_to_address',
		'do_date',
		'do_number',
		'so_date',
		'so_number',
		'rgu_date',
		'imei_flag'
	];
	
	public function __construct() {
		parent::__construct(ProgramNatunaAnambas::class, 'modules.programs.program_natuna_anambas');
	}
	
	private function dateInfo($table, $connection = null) {
		return diy_date_info($table, 'period', null, $connection);
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
		$this->setPage('Program Keren Merapi');
		$this->sessionFilters();
		
		$this->removeActionButtons(['add']);
		
		$this->table->connection($this->connection);
		
		$this->table->openTab('Summary');
		$this->table->setRightColumns([
			'allocation',
			'activation',
			'rgu'
		]);
		
		$this->table->label(' ');
		$this->table->addTabContent('<p>Tanggal Update Terakhir : ' . $this->dateInfo($this->model_table, $this->connection) . '</p>');
		$this->table->searchable(['period_string', 'product_name', 'destination', 'imei_flag']);
		$this->table->clickable(false);
		$this->table->sortable();
		
		$this->table->filterGroups('period_string', 'selectbox', true);
		$this->table->filterGroups('destination', 'selectbox');
		
		$this->table->lists($this->model_table, $this->fieldSummary, false);
		
		$this->table->openTab('Detail');
		$this->table->setRightColumns(['imei_flag']);
		
		$this->table->label(' ');
		$this->table->addTabContent('<p>Tanggal Update Terakhir : ' . $this->dateInfo('view_report_data_detail_natuna_anambas', $this->connection) . '</p>');
		$this->table->searchable(['period_string', 'destination', 'bts_province', 'bts_city', 'bts_name', 'product_name']);
		$this->table->clickable(false);
		$this->table->sortable();
		
		$this->table->filterGroups('period_string', 'selectbox', true);
		$this->table->filterGroups('destination', 'selectbox');
		
		$this->table->setHiddenColumns(['period_string']);
		$this->table->lists('view_report_data_detail_natuna_anambas', $this->fieldDetail, false);
		
		$this->table->closeTab();
		
		return $this->render();
	}
}