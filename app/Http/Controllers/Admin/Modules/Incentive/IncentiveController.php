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
		'ttlsite:Total Incentive',
		'avgbtsrev:AVG BTS Rev',
		'inctiveavgbtsrev:Incentive Rev AVG BTS ',
		'mxsubs:Max Subs',
		'mxsubsperiod:Max Subs Period',
		'grwthnetadd:Growth Nett Add',
		'inctivegrwthnetadd:Incentive Growth Nett Add',
		'ttlinctive:Total Incentive'
	];
	
	public function __construct() {
		parent::__construct(Incentive::class, 'modules.incentive');
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
		$this->table->format('tgtnetadd', 2);
		$this->table->format('achnetadd', 2);
		$this->table->format('scrnetadd', 2);
		$this->table->format('scrttl', 2);
		$this->table->format('avgbtsrev', 2);
		$this->table->format('ttlinctive', 2);
		
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