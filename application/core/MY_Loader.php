<?php defined('BASEPATH') OR exit('No direct script access allowed');
	/** custom loader file extends CI_Loader
	*/
	class MY_Loader extends CI_Loader {
		
		function __construct()
		{
			parent::__construct();
			
		}
		
		public function admin_template($template_name, $vars = array(), $return = FALSE)
		{
			$content  = $this->view('_templates/head', $vars, $return); // head - <html>
			$content  = $this->view('_templates/admin/body-wrapper', $vars, $return); // header
			$content  = $this->view('_templates/admin/header', $vars, $return); // header
			$content  = $this->view('_templates/admin/main-sidebar', $vars, $return); // main-side
			
			$content  = $this->view($template_name, $vars, $return); // view
			
			$content  = $this->view('_templates/footer', $vars, $return); // footer
			$content  = $this->view('_templates/admin/control-sidebar', $vars, $return); // control
			$content  = $this->view('_templates/foot', $vars, $return); // footer
			
			if ($return)
			{
				return $content;
			}
		}
		
		public function login_template($template_name, $vars = array(), $return = FALSE)
		{
			$content  = $this->view('_templates/login/head', $vars, $return); // head - <html>
			$content  = $this->view($template_name, $vars, $return); // view
			$content  = $this->view('_templates/login/foot', $vars, $return); // footer
			
			if ($return)
			{
				return $content;
			}
		}
		
		public function user_template($template_name, $vars = array(), $return = FALSE)
		{
			$content  = $this->view('_templates/head', $vars, $return); // head - <html>
			$content  = $this->view('_templates/user/body-wrapper', $vars, $return); // header
			$content  = $this->view('_templates/user/header', $vars, $return); // header
			$content  = $this->view('_templates/user/main-sidebar', $vars, $return); // main-side
			
			$content  = $this->view($template_name, $vars, $return); // view
			
			$content  = $this->view('_templates/footer', $vars, $return); // footer
			$content  = $this->view('_templates/user/control-sidebar', $vars, $return); // control
			$content  = $this->view('_templates/foot', $vars, $return); // footer
			
			if ($return)
			{
				return $content;
			}
		}
		
		public function modals($template_name, $vars = array(), $return = FALSE)
		{
			$content  = $this->view('_templates/modals/head', $vars, $return); // head
			$content  = $this->view($template_name, $vars, $return); // view
			$content  = $this->view('_templates/modals/foot', $vars, $return); // footer
			
			if ($return)
			{
				return $content;
			}
		}
		
		public function top_nav($template_name, $vars = array(), $return = FALSE)
		{
			$content  = $this->view('_templates/head', $vars, $return); // head
			$content  = $this->view('_templates/top_nav/body-wrapper', $vars, $return); // header
			$content  = $this->view('_templates/top_nav/header', $vars, $return); // header

			$content  = $this->view($template_name, $vars, $return); // view

			$content  = $this->view('_templates/footer', $vars, $return); // footer
			$content  = $this->view('_templates/foot', $vars, $return); // footer
			
			if ($return)
			{
				return $content;
			}
		}
	}					