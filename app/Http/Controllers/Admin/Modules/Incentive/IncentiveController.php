<?php
namespace App\Http\Controllers\Admin\Modules\Incentive;

use Incodiy\Codiy\Controllers\Core\Controller;
use App\Http\Controllers\Admin\Modules\Handler;
use App\Models\Admin\Modules\Incentive\Incentive;
/**
 * Created on Mar 16, 2023
 * 
 * Time Created : 2:31:55 PM
 *
 * @filesource  IncentiveController.php
 *
 * @author      wisnuwidi@gmail.com - 2023
 * @copyright   wisnuwidi@gmail.com,
 *              incodiy@gmail.com
 * @email       wisnuwidi@gmail.com
 */
class IncentiveController extends Controller {
	use Handler;
	
	public $data;
	
	private $id           = false;
	private $_set_tab     = [];
	private $_tab_config  = [];
	private $_hide_fields = ['id'];
	private $fieldset_asc = [
		'period_string:Period',
		'cor:COR',
		'region',
		'cluster',
		'sub_cluster',
		'nik:NIK',
		'nama',
		'jabatan',
		'po:PO',
		'tgtpo:Target PO',
		'achpo:ACH PO',
		'bbtpo:Bobot PO',
		'scrpo:Skor PO',
		'btsrev:BTS Rev',
		'tgtbtsrev:Target BTS Rev',
		'achbtsrev:ACH BTS Rev',
		'bbtbtsrev:Bobot BTS Rev',
		'scrbtsrev:Skor BTS Rev',
		'substhismonth:Subs Bulan Ini',
		'subslastmonth:Subs Bulan Lalu',
		'netadd:Nett Add',
		'tgtnetadd:Target Nett Add',
		'achnetadd:ACH Nett Add',
		'bbtnetadd:Bobot Nett Add',
		'scrnetadd:Skor Nett Add',
		'scrttl:Skor Total',
		'inctive:Incentive',
		'ttlsite:Total Site',
		'avgbtsrev:AVG BTS Rev',
		'inctiveavgbtsrev:Incentive Rev AVG BTS ',
		'mxsubs:Max Subs',
		'mxsubsperiod:Max Subs Period',
		'grwthnetadd:Growth Nett Add',
		'inctivegrwthnetadd:Incentive Growth Nett Add',
		'ttlinctive:Total Incentive'
	];
	private $fieldset_asm = [
	    'period_string:Period',
	    'cor:COR',
	    'region',
	    'cluster',
	    'nik:NIK',
	    'nama',
	    'po',
	    'target_po',
	    'ach_po',
	    'bobot',
	    'score_po',
	    'bts_revenue',
	    'target_bts',
	    'ach_bts_rev',
	    'bobot_bts_rev',
	    'score_bts_rev',
	    'netadd:Nett Add',
	    'target_netadd:Target Nett Add',
	    'ach_netadd:ACH Nett Add',
	    'bobot_netadd:Bobot Nett Add',
	    'score_netadd:Score Nett Add',
	    'totalscore:Total Score',
	    'incentive',
	    'totalsite:Total Site',
	    'averagebtsrevenue:AVG BTS Reveenue',
	    'incentivebtsrev:Incentive BTS Reveenue',
	    'substhismonth:Subs Bulan Ini',
	    'max_subs:Max Subs',
	    'monthmaxsubs:Max Subs Bulanan',
	    'growthnetadd:Growth Nett Add',
	    'netaddgrowthincentive:Incentive Growth Nett Add',
	    'totalincentive:Total Incentive'
	];
	private $fieldset_pic_cluster = [
	    'period_string:Period',
	    'cor:COR',
	    'region',
	    'cluster',
	    'nik:NIK',
	    'nama',
	    'selltrhuactive',
	    'target_sellthruactive:Target Sellthru Active',
	    'ach_selltrhuactive:ACH Sellthru Active',
	    'bobot',
	    'score_selltrhuactive:Score Sellthru Active',
	    'bts_revenue',
	    'target_bts',
	    'ach_bts_rev',
	    'bobot_bts_rev',
	    'score_bts_rev',
	    'netadd:Nett Add',
	    'target_netadd:Target Nett Add',
	    'ach_netadd:ACH Nett Add',
	    'bobot_netadd:Bobot Nett Add',
	    'score_netadd:Score Nett Add',
	    'totalscore:Total Score',
	    'incentive'
	];
	private $fieldset_pic_sub_cluster = [
	    'period_string:Period',
	    'cor:COR',
	    'region',
	    'cluster',
	    'nik:NIK',
	    'nama',
	    'jabatan',
	    'selltrhuactive',
	    'target_selltrhuactive',
	    'ach_selltrhuactive',
	    'bobot_selltrhuactive',
	    'score_selltrhuactive',
	    'bts_revenue',
	    'target_bt_rev',
	    'ach_bts_rev',
	    'bobot_btsrev',
	    'score_bts_rev',
	    'substhismonth',
	    'subslastmonth',
	    'netadd',
	    'target_netadd',
	    'ach_netadd',
	    'bobot_netadd',
	    'score_netadd',
	    'score_total',
	    'incentive'
	];
	
	public function __construct() {
		parent::__construct(Incentive::class, 'modules.incentive');
	}
	
	private function dateInfo($table, $connection = null) {
		return diy_date_info($table, 'running_date', "WHERE period IS NOT NULL", $connection);
	}
	
	public function index() {
		$this->setPage('Incentive');
		$this->sessionFilters();
		
		$this->removeActionButtons(['add']);
		
		$this->table->connection($this->connection);
		
		if (in_array($this->session['user_group'], array_merge(['root', $this->roleAlias])) || in_array($this->session['group_alias'], ['National']) || 'asc' === strtolower($this->session['group_info'])) {
    		$this->table->setCenterColumns(['cor']);
    		$this->table->setRightColumns([
    			'po',
    			'tgtpo',
    			'achpo',
    			'bbtpo',
    			'scrpo',
    			'btsrev',
    			'tgtbtsrev',
    			'achbtsrev',
    			'bbtbtsrev',
    			'scrbtsrev',
    			'substhismonth',
    			'subslastmonth',
    			'netadd',
    			'tgtnetadd',
    			'achnetadd',
    			'bbtnetadd',
    			'scrnetadd',
    			'scrttl',
    			'inctive',
    			'ttlsite',
    			'avgbtsrev',
    			'inctiveavgbtsrev',
    			'mxsubs',
    			'mxsubsperiod',
    			'grwthnetadd',
    			'inctivegrwthnetadd',
    			'ttlinctive'
    		], true, true);
    		
    		$this->table->format('tgtpo', 0);
    		$this->table->format('achpo', 2);
    		$this->table->format('scrpo', 2);
    		$this->table->format('btsrev', 2);
    		$this->table->format('tgtbtsrev', 0);
    		$this->table->format('achbtsrev', 2);
    		$this->table->format('scrbtsrev', 2);
    		$this->table->format('substhismonth', 0);
    		$this->table->format('subslastmonth', 0);
    		$this->table->format('netadd', 0);
    		$this->table->format('tgtnetadd', 2);
    		$this->table->format('achnetadd', 2);
    		$this->table->format('scrnetadd', 2);
    		$this->table->format('scrttl', 2);
    		$this->table->format('avgbtsrev', 2);
    		$this->table->format('inctive', 2);
    		$this->table->format('inctiveavgbtsrev', 2);
    		$this->table->format('mxsubs', 0);
    		$this->table->format('grwthnetadd', 0);
    		$this->table->format('inctivegrwthnetadd', 0);
    		$this->table->format('ttlinctive', 0);
			
    		$this->table->columnCondition('achpo', 'cell', '>=', 1, 'suffix', ' %');
    		$this->table->columnCondition('scrpo', 'cell', '>=', 1, 'suffix', ' %');
    		$this->table->columnCondition('achbtsrev', 'cell', '>=', 1, 'suffix', ' %');
    		$this->table->columnCondition('achnetadd', 'cell', '>=', 1, 'suffix', ' %');
    		$this->table->columnCondition('scrnetadd', 'cell', '>=', 1, 'suffix', ' %');
    		$this->table->columnCondition('scrbtsrev', 'cell', '>=', 1, 'suffix', ' %');
    		$this->table->columnCondition('scrttl', 'cell', '>=', 1, 'suffix', ' %');
    		
    		$this->table->filterGroups('period_string', 'selectbox', true);
    		$this->table->filterGroups('cor', 'selectbox', true);
    		$this->table->filterGroups('region', 'selectbox', true);
    		$this->table->filterGroups('cluster', 'selectbox');
    		
    		$this->table->clickable(false);
    		$this->table->sortable();
    		
    		$this->table->openTab('Summary ASC');
    		$this->table->searchable(['period_string', 'cor', 'region', 'cluster']);
    		$this->table->label(' ');
    		$this->table->addTabContent('<p>Tanggal Update Terakhir : ' . $this->dateInfo($this->model_table, $this->connection) . '</p>');
    		
    		$this->table->displayRowsLimitOnLoad('*');
    		$this->table->lists($this->model_table, $this->fieldset_asc, false);
    		$this->table->clearOnLoad();
		}
		
		$this->table->format('score_po', 2);		
		$this->table->format('target_po', 0);
		$this->table->format('ach_po', 2);
		$this->table->format('scrpo', 2);
		$this->table->format('bts_revenue', 2);
		$this->table->format('target_bts', 0);
		$this->table->format('ach_bts_rev', 2);
		$this->table->format('score_bts_rev', 2);
		$this->table->format('target_netadd', 2);
		$this->table->format('ach_netadd', 2);
		$this->table->format('score_netadd', 2);
		$this->table->format('totalscore', 2);
		$this->table->format('averagebtsrevenue', 2);
		
		$this->table->format('substhismonth', 0);
		$this->table->format('subslastmonth', 0);
		$this->table->format('netadd', 0);
		$this->table->format('max_subs', 0);
		$this->table->format('growthnetadd', 0);
		$this->table->format('netaddgrowthincentive', 0);
		$this->table->format('totalsite', 0);
		$this->table->format('incentivebtsrev', 0);
		
		$this->table->columnCondition('ach_po', 'cell', '>=', 1, 'suffix', ' %');
		$this->table->columnCondition('bobot', 'cell', '>=', 1, 'suffix', ' %');
		$this->table->columnCondition('score_po', 'cell', '>=', 1, 'suffix', ' %');
		$this->table->columnCondition('score_bts_rev', 'cell', '>=', 1, 'suffix', ' %');
		$this->table->columnCondition('ach_netadd', 'cell', '>=', 1, 'suffix', ' %');
		$this->table->columnCondition('score_netadd', 'cell', '>=', 1, 'suffix', ' %');
		$this->table->columnCondition('totalscore', 'cell', '>=', 1, 'suffix', ' %');
		
		if (in_array($this->session['user_group'], array_merge(['root', $this->roleAlias])) || in_array($this->session['group_alias'], ['National'])  || 'asm' === strtolower($this->session['group_info'])) {
		    $this->table->setCenterColumns(['cor']);
		    $this->table->setRightColumns([
		        'po',
		        'target_po',
		        'ach_po',
		        'bobot',
		        'score_po',
		        'bts_revenue',
		        'target_bts',
		        'ach_bts_rev',
		        'bobot_bts_rev',
		        'score_bts_rev',
		        'netadd',
		        'target_netadd',
		        'ach_netadd',
		        'bobot_netadd',
		        'score_netadd',
		        'totalscore',
		        'incentive',
		        'totalsite',
		        'averagebtsrevenue',
		        'incentivebtsrev',
		        'substhismonth',
		        'max_subs',
		        'monthmaxsubs',
		        'growthnetadd',
		        'netaddgrowthincentive',
		        'totalincentive'
		    ], true, true);
		    
		    $this->table->format('max_subs', 0);
		    $this->table->format('monthmaxsubs', 0);
		    $this->table->format('totalincentive', 0);
		    
		    $this->table->columnCondition('score_po', 'cell', '>=', 1, 'suffix', ' %');
		    $this->table->columnCondition('ach_bts_rev', 'cell', '>=', 1, 'suffix', ' %');
		    
		    $this->table->filterGroups('period_string', 'selectbox', true);
		    $this->table->filterGroups('cor', 'selectbox', true);
		    $this->table->filterGroups('region', 'selectbox', true);
		    $this->table->filterGroups('cluster', 'selectbox');
		    
		    $this->table->clickable(false);
		    $this->table->sortable();
		    
		    $this->table->openTab('Summary ASM');
		    $this->table->searchable(['period_string', 'cor', 'region', 'cluster']);
		    $this->table->label(' ');
		    $this->table->addTabContent('<p>Tanggal Update Terakhir : ' . $this->dateInfo('report_data_summary_incentive_asm', $this->connection) . '</p>');
		    
		    $this->table->displayRowsLimitOnLoad('*');
		    $this->table->lists('report_data_summary_incentive_asm', $this->fieldset_asm, false);
		    $this->table->clearOnLoad();
		}
		
		$this->table->format('selltrhuactive', 0);
		$this->table->format('target_sellthruactive', 2);
		$this->table->format('ach_selltrhuactive', 2);
		$this->table->format('score_selltrhuactive', 2);
		
		$this->table->columnCondition('ach_selltrhuactive', 'cell', '>=', 1, 'suffix', ' %');
		$this->table->columnCondition('score_selltrhuactive', 'cell', '>=', 1, 'suffix', ' %');
		
		if (in_array($this->session['user_group'], array_merge(['root', $this->roleAlias])) || in_array($this->session['group_alias'], ['National'])  || 'pic_cluster' === strtolower($this->session['group_info'])) {
		    $this->table->setCenterColumns(['cor']);
		    $this->table->setRightColumns([
		        'selltrhuactive',
		        'target_sellthruactive',
		        'ach_selltrhuactive',
		        'bobot',
		        'score_selltrhuactive',
		        'bts_revenue',
		        'target_bts',
		        'ach_bts_rev',
		        'bobot_bts_rev',
		        'score_bts_rev',
		        'netadd',
		        'target_netadd',
		        'ach_netadd',
		        'bobot_netadd',
		        'score_netadd',
		        'totalscore',
		        'incentive'
		    ], true, true);
		    
		    $this->table->columnCondition('ach_bts_rev', 'cell', '>=', 1, 'suffix', ' %');
		    $this->table->columnCondition('ach_selltrhuactive', 'cell', '>=', 1, 'suffix', ' %');
		    
		    $this->table->filterGroups('period_string', 'selectbox', true);
		    $this->table->filterGroups('cor', 'selectbox', true);
		    $this->table->filterGroups('region', 'selectbox', true);
		    $this->table->filterGroups('cluster', 'selectbox');
		    
		    $this->table->clickable(false);
		    $this->table->sortable();
		    
		    $this->table->openTab('Summary PIC Cluster');
		    $this->table->searchable(['period_string', 'cor', 'region', 'cluster']);
		    $this->table->label(' ');
		    $this->table->addTabContent('<p>Tanggal Update Terakhir : ' . $this->dateInfo('report_data_summary_incentive_pic_cluster', $this->connection) . '</p>');
		    
		    $this->table->displayRowsLimitOnLoad('*');
		    $this->table->lists('report_data_summary_incentive_pic_cluster', $this->fieldset_pic_cluster, false);
		    $this->table->clearOnLoad();
		}
		
		if (in_array($this->session['user_group'], array_merge(['root', $this->roleAlias])) || in_array($this->session['group_alias'], ['National'])  || 'pic_sub_cluster' === strtolower($this->session['group_info'])) {
		    $this->table->setCenterColumns(['cor']);
		    $this->table->setRightColumns([
		        'selltrhuactive',
		        'target_selltrhuactive',
		        'ach_selltrhuactive',
		        'bobot_selltrhuactive',
		        'score_selltrhuactive',
		        'bts_revenue',
		        'target_bt_rev',
		        'ach_bts_rev',
		        'bobot_btsrev',
		        'score_bts_rev',
		        'substhismonth',
		        'subslastmonth',
		        'netadd',
		        'target_netadd',
		        'ach_netadd',
		        'bobot_netadd',
		        'score_netadd',
		        'score_total',
		        'incentive'
		    ], true, true);
		    
		    $this->table->format('selltrhuactive', 0);
		    $this->table->format('target_selltrhuactive', 2);
		    $this->table->format('target_bt_rev', 2);
		    $this->table->format('incentive', 0);
		    
		    $this->table->columnCondition('ach_bts_rev', 'cell', '>=', 1, 'suffix', ' %');
		    $this->table->columnCondition('ach_selltrhuactive', 'cell', '>=', 1, 'suffix', ' %');
		    
		    $this->table->filterGroups('period_string', 'selectbox', true);
		    $this->table->filterGroups('cor', 'selectbox', true);
		    $this->table->filterGroups('region', 'selectbox', true);
		    $this->table->filterGroups('cluster', 'selectbox');
		    
		    $this->table->clickable(false);
		    $this->table->sortable();
		    
		    $this->table->openTab('Summary PIC Sub Cluster');
		    $this->table->searchable(['period_string', 'cor', 'region', 'cluster']);
		    $this->table->label(' ');
		    $this->table->addTabContent('<p>Tanggal Update Terakhir : ' . $this->dateInfo('report_data_summary_incentive_pic_sub_cluster', $this->connection) . '</p>');
		    
		    $this->table->displayRowsLimitOnLoad('*');
		    $this->table->lists('report_data_summary_incentive_pic_sub_cluster', $this->fieldset_pic_sub_cluster, false);
		    $this->table->clearOnLoad();
		}
		
		$this->table->closeTab();
		
		return $this->render();
	}
}