<?php
/**
 * Created on 27 Apr 2021
 * Time Created	: 05:47:36
 *
 * @filesource	datatable-search.blade.php
 *
 * @author		wisnuwidi@gmail.com - 2021
 * @copyright	wisnuwidi
 * @email		wisnuwidi@gmail.com
 */
?>

@if (!empty($components->table->filter_contents)) 
	{!! diy_modal_content_box($components->table->filter_contents) !!}
@endif