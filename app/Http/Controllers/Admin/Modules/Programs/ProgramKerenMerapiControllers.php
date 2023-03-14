<?php
namespace App\Http\Controllers\Admin\Modules\Programs;

use Incodiy\Codiy\Controllers\Core\Controller;
use App\Models\Admin\Modules\Programs\ProgramKerenMerapi;

/**
 * Created on 19 Feb 2023
 * 
 * Time Created : 20:28:22
 *
 * @filesource  ProgramKerenMerapiControllers.php
 *
 * @author      wisnuwidi@gmail.com - 2023
 * @copyright   wisnuwidi@gmail.com,
 *              incodiy@gmail.com
 * @email       wisnuwidi@gmail.com
 */

class ProgramKerenMerapiControllers extends Controller {
    public  $data;
    private $fields = [
        'start_date:Period',
        'asof_date_day:Hari',
        'program:Nama Program',
        'no_outlet_induk:Total Outlet Induk',
        'no_outlet_cabang:Total Outlet Cabang',
        'total_revenue',
        'total_eligible_revenue:Total Revenue Inner',
        'total_revenue_outer',
        'percent_inner:% Inner',
        'percent_outer:% Outer',
        'total_eligible_revenue_sp_new_imei:Total Revenue SP IMEI',
        'total_eligible_revenue_sp:Total Revenue Inner SP',
        'total_eligible_revenue_vd:Total Revenue Inner VD',
        'total_eligible_revenue_ipp:Total Revenue Inner Paket Data',
        'qty_all_act:Jumlah Aktifasi',
        'qty_eligible_act:Jumlah Aktifasi Inner'
    ];
    
    public function __construct() {
        parent::__construct(ProgramKerenMerapi::class, 'modules.programs.program_keren_merapi');
    }
    
    private function dateInfo($table, $connection = null) {
        return diy_date_info($table, 'start_date', null, $connection);
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
        
        $this->table->setCenterColumns(['program']);
        $this->table->setRightColumns([
            'no_outlet_induk',
            'no_outlet_cabang',
            'total_revenue',
            'total_eligible_revenue',
            'total_revenue_outer',
            'percent_inner',
            'percent_outer',
            'total_eligible_revenue_sp_new_imei',
            'total_eligible_revenue_sp',
            'total_eligible_revenue_vd',
            'total_eligible_revenue_ipp',
            'qty_all_act',
            'qty_eligible_act'
        ]);
        
        $this->table->format('total_revenue', 2);
        $this->table->format('total_eligible_revenue', 2);
        $this->table->format('total_revenue_outer', 2);
        $this->table->format('percent_inner', 2);
        $this->table->format('percent_outer', 2);
        $this->table->format('total_eligible_revenue_sp_new_imei', 2);
        $this->table->format('total_eligible_revenue_sp', 2);
        $this->table->format('total_eligible_revenue_vd', 2);
        $this->table->format('total_eligible_revenue_ipp', 2);
        $this->table->format('qty_all_act', 2);
        $this->table->format('qty_eligible_act', 2);
        
        $this->table->label(' ');
        $this->table->addTabContent('<p>Tanggal Update Terakhir : ' . $this->dateInfo($this->model_table, $this->connection) . '</p>');
        $this->table->searchable(['start_date', 'program']);
        $this->table->clickable(false);
        $this->table->sortable();
        
        $this->table->filterGroups('start_date', 'selectbox', true);
        $this->table->filterGroups('program', 'selectbox');
        
        $this->table->lists($this->model_table, $this->fields, false);
        
        return $this->render();
    }
}