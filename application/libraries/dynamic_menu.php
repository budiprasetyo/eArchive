<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/*
 * Dynamic_menu.php
 * 
 * Copyright 2012 metamorph <metamorph@metamorph>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 * 
 * 
 */



class Dynamic_menu
{
	private $ci;	// parameter CodeIgniter Super Global References
	private $id_menu		= 'id="menu"';
	private $class_menu		= 'class="menu"';
	private $class_username	= 'class="username"';
	private $class_parent	= 'class="parent"';
	private $class_last		= 'class="last"';
	/**
	 * Constructor of class Dynamic_menu.
	 *
	 * @return void
	 */
	public function __construct()
	{
		// get a reference to CodeIgniter
		$this->ci =& get_instance();
	}

	// --------------------------------------------------------------------
     /**
     * build_menu($table, $type)
     *
     * Description:
     *
     * builds the Dynamic dropdown menu
     * $table allows for passing in a MySQL table name for different menu tables.
     * $type is for the type of menu to display ie; topmenu, mainmenu, sidebar menu
     * or a footer menu.
     *
     * @param    string    the MySQL database table name.
     * @param    string    the type of menu to display.
     * @return    string    $html_out using CodeIgniter achor tags.
     */
     function build_menu($type)
     {
		 $menu 	= array();
		 $username		= $this->ci->session->userdata('username');
		 $users			= $this->ci->db->query("SELECT id_r_privilege FROM users WHERE username = '".$username."'");
		 $user			= $users->row();
		 $query			= $this->ci->db->query("SELECT * FROM dyn_menu WHERE id_r_privilege LIKE '%".$user->id_r_privilege."%'");
		 
		 // build the dynamic menus
		 $html_out	= "\t".'<div '.$this->id_menu.'>'."\n";
		 
		 /**
         * check $type for the type of menu to display.
         *
         * ( 0 = top menu ) ( 1 = horizontal ) ( 2 = vertical ) ( 3 = footer menu ).
         */
         switch($type)
         {
			case 0:			
				break;
			
			case 1:
				$html_out .= "\t\t".'<ul '.$this->class_menu.'>'."\n";
				break;
				
			case 2:
				break;
				
			case 3:
				break;
				
			default:
				$html_out .= "\t\t".'<ul '.$this->class_menu.'>'."\n";
				break;
		 }
		 
		 // query to row
		 foreach($query->result() as $row)
		 {
			 $id			= $row->id;
			 $title			= $row->title;
			 $link_type		= $row->link_type;
			 $page_id		= $row->page_id;
			 $module_name 	= $row->module_name;
			 $url			= $row->url;
			 $uri			= $row->uri;
			 $dyn_group_id	= $row->dyn_group_id;
			 $position		= $row->position;
			 $target		= $row->target;
			 $parent_id		= $row->parent_id;
			 $is_parent		= $row->is_parent;
			 $show_menu		= $row->show_menu;
			 
			 {
				 if($show_menu && $parent_id == 0)  // are we allowed to see this menu?
				 {
					 if($is_parent == TRUE)
					 {
						 // CodeIgniter's anchor (uri segments, text, attributes) tag
						 $html_out .= "\t\t\t".'<li>'.anchor($url.' '.$this->class_parent, '<span>'.$title.'</span>', 'name="'.$title.'" id="'.$id.'" target="'.$target.'"');
					 }
					 else
					 {
						 $html_out .= "\t\t\t".'<li>'.anchor($url, '<span>'.$title.'</span>', 'name="'.$title.'" id="'.$id.'" target="'.$target.'"');
					 }
				 }
			 }
			 $html_out .= $this->get_childs($id);
			 // print_r($id);
		 }
		 // loop through and build all the child submenus
		 $html_out .= '</li>'."\n";
		 $html_out .= "\t\t".'</ul>'."\n";
		 $html_out .= "\t\t\t".'<ul><span '.$this->class_username.'>Username '.$username.'</span></ul>'."\n";
		 $html_out .= "\t".'</div>'."\n";

		 return $html_out;
	 }
	
	/**
     * get_childs($menu, $parent_id) - SEE Above Method.
     *
     * Description:
     *
     * Builds all child submenus using a recurse method call.
     *
     * @param    mixed    $id
     * @param    string    $id usuario
     * @return    mixed    $html_out if has subcats else FALSE
     */
     function get_childs($id)
     {
		 $has_subcats	= FALSE;
		 
		 $html_out  = '';
		 $html_out .= "\n\t\t\t\t".'<div>'."\n";
		 $html_out .= "\t\t\t\t\t".'<ul>'."\n";
		 
		 // query submenu
		 $query = $this->ci->db->query("SELECT * FROM dyn_menu WHERE parent_id = '$id'");
		 
		 foreach($query->result() as $row)
		 {
			 $id			= $row->id;
			 $title			= $row->title;
			 $link_type		= $row->link_type;
			 $page_id		= $row->page_id;
			 $module_name	= $row->module_name;
			 $url			= $row->url;
			 $uri			= $row->uri;
			 $dyn_group_id	= $row->dyn_group_id;
			 $position		= $row->position;
			 $target		= $row->target;
			 $parent_id		= $row->parent_id;
			 $is_parent		= $row->is_parent;
			 $show_menu		= $row->show_menu;
			 
			 $has_subcats	= TRUE;
			 
			 if($is_parent == TRUE)
			 {
				$html_out	.= "\t\t\t\t\t\t".'<li>'.anchor($url.' '.$this->class_parent, '<span>'.$title.'</span>', 'name="'.$title.'" id="'.$id.'" target="'.$target.'"');
			 }
			 else
			 {
				$html_out	.= "\t\t\t\t\t\t".'<li>'.anchor($url, '<span>'.$title.'</span>', 'name="'.$title.'" id="'.$id.'" target="'.$target.'"');
			 }
			 
			 // Recurse call to get more child submenus
			 $html_out		.= $this->get_childs($id);
		 }
		 $html_out	.= '</li>'."\n";
		 $html_out	.= "\t\t\t\t\t".'</ul>'."\n";
		 $html_out	.= "\t\t\t\t".'</div>'."\n";
		 
		 return($has_subcats) ? $html_out : FALSE;
	 }
}

// ------------------------------------------------------------------------
// End of Dynamic_menu Library Class.
// ------------------------------------------------------------------------
/* End of file Dynamic_menu.php */
/* Location: ../application/libraries/Dynamic_menu.php */
