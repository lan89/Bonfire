<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sidebar extends Base_Controller {

	private $actions = array();

	//--------------------------------------------------------------------

	public function index($type=null) 
	{	
		// Get a list of modules with a controller matching
		// $type ('content', 'appearance', 'settings', 'stats', or 'developer')
		foreach (module_list() as $module)
		{
			if (module_controller_exists($type, $module))
			{
				$this->actions[] = $module;
			}
		}
		
		// Do we have any actions? 
		if (!count($this->actions))
		{
			return '';
		}
		
		// Build a ul to return
		$list = "<ul>\n";
		
		foreach ($this->actions as $module)
		{
			// Is this the current module? 
			if ($module == $this->uri->segment(3))
			{
				$class = 'class="current"';
			}
			else
			{
				$class = '';
			}
			
			// Build our list item.
			$list .= '<li><a href="'. site_url('admin/'. $type .'/'. $module) .'" '. $class;
			// Icon
			/*
			if ($icon = module_icon($module))
			{
				$list .= ' style="background: url('. $icon .')"';
			}
			*/
			$list .= '>'. ucwords(str_replace('_', '', $module)) ."</a></li>\n";
		}
		
		$list .= "</ul>\n";
		
		return $list;
	}
	
	//--------------------------------------------------------------------
	

}

// End sidebar class