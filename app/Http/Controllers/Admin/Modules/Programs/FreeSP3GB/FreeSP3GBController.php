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
 * @author	  wisnuwidi@gmail.com - 2023
 * @copyright   wisnuwidi@gmail.com,
 *			  incodiy@gmail.com
 * @email	   wisnuwidi@gmail.com,
 *			  incodiy@gmail.com
 */
class FreeSP3GBController extends Controller {
	use Handler;
	
	private $fields = [
		'distributor_name',
		'region',
		'cluster',
		'sub_cluster',
		'target:Target Free SP',
		'act_usage:Usage BTS Most<br />ACT Usage',
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
		$this->chart->connection($this->connection);
		
		if (in_array($this->session['user_group'], array_merge(['root', $this->roleAlias])) || 'outlet' !== strtolower($this->session['group_info'])) {
			
		//	$this->table->openTab('Summary');
			$this->chart->column (
				$this->model_table, // source
				['region', 'act_usage', 'act_usage_imei'], // fieldset
				'act_usage::sum,act_usage_imei::sum',	  // format
				'region',	   // category
				'region',	   // groups
				'region::DESC'  // order
			);
			/* 
			$this->chart->canvas('column', $this->model_table, ['period', 'region', 'act_usage'], 'name:period|data:act_usage::sum', 'region', 'period, region', 'region::DESC');
			$this->chart->canvas (
				'column',
				$this->model_table, // source
				['region', 'act_usage', 'act_usage_imei'], // fieldset
				'act_usage::sum,act_usage_imei::sum',	  // format
				'region',	   // category
				'region',	   // groups
				'region::DESC'  // order
			);
			 */
			/* 
			$this->table->mergeColumns('Activation NEW IMEI<br />( BTS Most Usage D+7)', ['act_usage_imei', 'ach_usage_imei']);
			$this->table->setCenterColumns(['program_name', 'cor', 'outlet_id']);
			$this->table->setRightColumns([			
				'act_usage',
				'act_usage_imei',
				'ach_usage_imei'
			]);
			$this->table->format('ach_target', 2);
			$this->table->format('ach_usage_imei', 2);
			$this->table->columnCondition('ach_usage_imei', 'cell', '>=', 1, 'suffix', ' %');
			
			$this->table->label(' ');
			$this->table->addTabContent('<p>Start Program : ' . $this->dateInfo($this->model_table, $this->connection) . '</p>');
			$this->table->addTabContent('<p>Update Date : ' . $this->startDateInfo($this->model_table, $this->connection) . '</p>');
			$this->table->addTabContent('
				<br/>
				<p style="margin-bottom: 1px !important;"><i><b>Eligible Refund</b></i></p>
				<div style="background-color: #fbf2f2; margin: 0; padding: 10px; border: #fdd1d1 solid 1px; border-radius: 4px;">
					<p style="margin-bottom: 1px !important;"><i>Sub Cluster yang di-registrasi pada program FREE SP 3GB Cocktail to Sub Cluster Area</i></p>
					<p style="margin-bottom: 1px !important;"><i>MDN mempunyai usage terbanyak selama 7 hari di BTS Sub Cluster yang di-registrasi, serta memiliki NEW IMEI</i></p>
				</div>
			');
			$this->table->searchable(['period_string', 'region', 'cluster', 'distributor_name']);
			$this->table->clickable(false);
			$this->table->sortable();
			
			$this->table->filterGroups('period_string', 'selectbox', true);
			$this->table->filterGroups('region', 'selectbox', true);
			$this->table->filterGroups('cluster', 'selectbox', true);
			$this->table->filterGroups('distributor_name', 'selectbox', true);
			
			$this->table->lists($this->model_table, $this->fields, false);
			$this->table->closeTab(); */
		}
	//	dd($this->chart, $this->table);
		return $this->render();
	}
}