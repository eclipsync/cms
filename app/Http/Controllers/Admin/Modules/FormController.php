<?php
namespace App\Http\Controllers\Admin\Modules;

use Incodiy\Codiy\Controllers\Admin\Modules\FormController as Form;
use App\Models\Admin\Modules\Reports\Challange;
use Incodiy\Codiy\Controllers\Core\Controller;

/**
 * Created on 23 Mar 2021
 * Time Created	: 17:35:59
 *
 * @filesource	FormController.php
 *
 * @author		wisnuwidi@gmail.com - 2021
 * @copyright	wisnuwidi
 * @email		wisnuwidi@gmail.com
 */
 
class FormController extends Controller {
	use Handler;
	
	public  $data;
	private $fieldSummary = [
		'cor:COR',
		'actual_act',
	//	'ach_act:%Ach',
		'actual_outlet',
	//	'ach_outlet:%Ach ',
		'actual_subs_per_bts',
	//	'ach_subs:%Ach  ',
		'actual_rev_per_bts',
	//	'ach_rev:%Ach   ',
	];
	
	public function __construct() {
		parent::__construct(Challange::class, 'modules.reports.challange');
	}
	
	private function dateInfo($table, $connection = null) {
		return diy_date_info($table, 'period', "WHERE period IS NOT NULL", $connection);
	}
	
	private $totalPercentage = [];
	private function totalPercentage() {
		$query = diy_query("SELECT ach_act, ach_outlet, ach_subs, ach_rev  FROM {$this->model_table} WHERE cor = 'ALL';", 'SELECT', $this->connection);
		
		$this->totalPercentage = $query[0];
	}
	
	public function index() {
		$this->setPage();
		
		$this->table->connection($this->connection);
		$this->chart->connection($this->connection);
		
		$this->table->searchable(['period', 'region']);
		$this->table->filterGroups('period', 'selectbox', true);
		$this->table->filterGroups('region', 'selectbox', false);
		$this->table->lists('report_data_chart_bar_with_negative_value', ['period', 'region', 'total_act', 'total_act_minus'], false);
		
		$this->table->chartOptions('title', 'Report Chart');
		$this->table->chartOptions('subtitle', 'Test');
		$this->table->chartOptions('detectNegativeValue', true);
	//	$this->table->chartOptions('stack', false);
		$this->table->chart(
			'column',
			['period', 'region', 'total_act', 'total_act_minus'],
			'name:period|total_act::sum|total_act_minus::sum',
			'region',
			'region, period',
			'region::DESC'
		);
		
		
		
		$this->table->searchable(['period', 'region']);
		$this->table->filterGroups('period', 'selectbox', true);
		$this->table->filterGroups('region', 'selectbox', false);
		$this->table->lists('report_data_monthly_program_keren', ['period', 'region', 'total_all_revenue', 'total_sp_new_imei_revenue'], false);
		
		$this->table->chartOptions('title', 'Report Chart');
		$this->table->chartOptions('subtitle', 'Test');
		$this->table->chartOptions('detectNegativeValue', true);
	//	$this->table->chartOptions('stack', false);
		$this->table->chart(
			'column',
			['region', 'total_all_revenue', 'total_sp_new_imei_revenue'],
			'region|total_all_revenue::sum|total_sp_new_imei_revenue::sum',
			'region',
			'region',
			'region::DESC'
		);
		/* 
		$this->chart->subtitle('Test');
		$this->chart->detectNegativeValue();
		$this->chart->bar(
			'report_data_chart_bar_with_negative_value', 
			['period', 'region', 'total_act', 'total_act_minus'], 
			'name:period|total_act::sum|total_act_minus::sum', 
			'region', 
			'region, period', 
			'region::DESC'
		);
		 */
		/* 
		$this->chart->line('report_data_chart_bar_with_negative_value', ['period', 'region', 'total_all_revenue'], 'name:period|data:total_all_revenue::sum', 'region', 'region::DESC, total_all_revenue::DESC', 'region, period');
	 //   $this->chart->dualAxesLineAndColumn('report_data_monthly_program_keren_pro_data', ['period', 'region', 'total_all_revenue', 'total_package_30k'], 'name:period|data:total_all_revenue::sum|combine:total_package_30k::sum::legend:true', 'region', 'period::DESC, region::DESC, total_all_revenue::DESC', 'region, period');
		$this->chart->bar('report_data_monthly_program_keren_pro_data', ['period', 'region', 'total_all_revenue'], 'name:period|data:total_all_revenue::sum', 'region', 'region::DESC, total_all_revenue::DESC', 'region, period');
		$this->chart->area('report_data_monthly_program_keren_pro_data', ['period', 'region', 'total_all_revenue'], 'name:period|data:total_all_revenue::sum', 'region', 'region::DESC, total_all_revenue::DESC', 'region, period');
		 */
		return $this->render();
	}
	
	public function index1() {
		$this->setPage('100 Days Challange');
		$this->sessionFilters();
		
		$this->removeActionButtons(['add']);
		$this->totalPercentage();
		
		$this->table->connection($this->connection);
		
		$this->table->openTab('Summary');
		/* 
		$this->table->mergeColumns('Activation', ['actual_act', 'ach_act']);
		$this->table->mergeColumns('Outlet', ['actual_outlet', 'ach_outlet']);
		$this->table->mergeColumns('SUBS/BTS', ['actual_subs_per_bts', 'ach_subs']);
		$this->table->mergeColumns('REV/BTS (Mn)', ['actual_rev_per_bts', 'ach_rev']);
		
		$this->table->format('actual_act', 0);
		$this->table->format('ach_act', 0);
		
		$this->table->format('actual_outlet', 0);
		$this->table->format('ach_outlet', 0);
		
		$this->table->format('actual_subs_per_bts', 0);
		$this->table->format('ach_subs', 0);
		
		$this->table->format('actual_rev_per_bts', 0);
		$this->table->format('ach_rev', 0);
		
		$this->table->columnCondition('cor', 'row', '===', 'ALL', 'background-color', 'rgb(255, 242, 204)');
		$this->table->columnCondition('cor', 'cell', 'LIKE', "COR", 'background-color', 'rgb(216, 236, 210)');
		$this->table->columnCondition('cor', 'cell', 'NOT LIKE', "COR|ALL", 'text-indent', '8px');
		
		
		$this->table->columnCondition('ach_act', 'cell', '<', $this->totalPercentage->ach_act, 'color', 'red');
		$this->table->columnCondition('ach_act', 'cell', '>=', $this->totalPercentage->ach_act, 'color', 'green');
		
		$this->table->columnCondition('ach_outlet', 'cell', '<', $this->totalPercentage->ach_outlet, 'color', 'red');
		$this->table->columnCondition('ach_outlet', 'cell', '>=', $this->totalPercentage->ach_outlet, 'color', 'green');
		
		$this->table->columnCondition('ach_subs', 'cell', '<', $this->totalPercentage->ach_subs, 'color', 'red');
		$this->table->columnCondition('ach_subs', 'cell', '>=', $this->totalPercentage->ach_subs, 'color', 'green');
		
		$this->table->columnCondition('ach_rev', 'cell', '<', $this->totalPercentage->ach_rev, 'color', 'red');
		$this->table->columnCondition('ach_rev', 'cell', '>=', $this->totalPercentage->ach_rev, 'color', 'green');
		
		$this->table->columnCondition('ach_act', 'cell', '>=', 1, 'suffix', ' %');
		$this->table->columnCondition('ach_outlet', 'cell', '>=', 1, 'suffix', ' %');
		$this->table->columnCondition('ach_subs', 'cell', '>=', 1, 'suffix', ' %');
		$this->table->columnCondition('ach_rev', 'cell', '>=', 1, 'suffix', ' %');
		
		$this->table->setCenterColumns([
			'ach_act',
			'actual_outlet',
			'ach_outlet',
			'ach_subs',
			'ach_rev'
		]);
		$this->table->setRightColumns([
			'actual_act',
			'actual_subs_per_bts',
			'actual_rev_per_bts'
		]);
		 */
		$this->table->label(' ');
		$this->table->addTabContent('<p>As of: ' . $this->dateInfo($this->model_table, $this->connection) . '</p>');
		$this->table->searchable(['period_string', 'cor']);
		$this->table->clickable(false);
		$this->table->sortable(false);
	//	$this->table->orderby('id', 'asc');
		
		$this->table->displayRowsLimitOnLoad('*');
		$this->table->lists($this->model_table, $this->fieldSummary, false);
		
		$this->table->addTabContent($this->chart());
		$this->table->closeTab();
		
		return $this->render();
	}
	
	private function chart() {
		return "
<script src=\"https://code.highcharts.com/highcharts.js\"></script>
<script src=\"https://code.highcharts.com/modules/exporting.js\"></script>
<script src=\"https://code.highcharts.com/modules/export-data.js\"></script>
<script src=\"https://code.highcharts.com/modules/accessibility.js\"></script>
<div id=\"container\"></div>
<script>
Highcharts.chart('container', {
	data: {
		table: '{$this->table->tableID[$this->table->tableName]}'
	},
	chart: {
		type: 'column'
	},
	title: {
		text: 'Live births in Norway'
	},
	subtitle: {
		text:
			'Source: <a href=\"https://www.ssb.no/en/statbank/table/04231\" target=\"_blank\">SSB</a>'
	},
	xAxis: {
		type: 'category'
	},
	yAxis: {
		allowDecimals: false,
		title: {
			text: 'Amount'
		}
	},
	tooltip: {
		formatter: function () {
			return '<b>' + this.series.name + '</b><br/>' +
				this.point.y + ' ' + this.point.name.toLowerCase();
		}
	}
});
</script>";
	}
}