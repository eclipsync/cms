<?php
namespace App\Http\Controllers\Admin\Modules\Programs;

use Incodiy\Codiy\Controllers\Core\Controller;
use App\Models\Admin\Modules\Programs\ProgramTrikomWireless;

/**
 * Created on 19 Feb 2023
 * 
 * Time Created : 21:26:39
 *
 * @filesource  ProgramTrikomWirelessControllers.php
 *
 * @author      wisnuwidi@gmail.com - 2023
 * @copyright   wisnuwidi@gmail.com,
 *              incodiy@gmail.com
 * @email       wisnuwidi@gmail.com
 */
class ProgramTrikomWirelessControllers extends Controller {
    public  $data;
    private $fields = [
        'period',
        'period_string:Period String',
        'activation_date',
        'partner_code',
        'partner_name',
        'product_name',
        'settlement',
        'mdn',
        'flag_5gb:Flag 5GB',
        'vol_mb: MB Vol',
        'period_usage: Period Usage',
        'total_usage',
        'last_update_data'
    ];
    
    public function __construct() {
        parent::__construct(ProgramTrikomWireless::class, 'modules.programs.program_trikom_wireless');
    }
    
    private function dateInfo($table, $connection = null) {
        return diy_date_info($table, 'period_usage', null, $connection);
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
        
        $this->table->setCenterColumns(['mdn']);
        $this->table->setRightColumns([
            'vol_mb',
            'total_usage'
        ]);
                
        $this->table->label(' ');
        $this->table->addTabContent('<p>Tanggal Update Terakhir : ' . $this->dateInfo($this->model_table, $this->connection) . '</p>');
        $this->table->searchable(['period_usage', 'mdn', 'flag_5gb']);
        $this->table->clickable(false);
        $this->table->sortable();
        
        $this->table->filterGroups('period_usage', 'selectbox', true);
        $this->table->filterGroups('mdn', 'selectbox', true);
        $this->table->filterGroups('flag_5gb', 'selectbox');
        
        $this->table->lists($this->model_table, $this->fields, false);
        
        return $this->render();
    }
}