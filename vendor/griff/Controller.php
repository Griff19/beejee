<?php


namespace griff;

/**
 * Class Controller
 * @package griff
 */
class Controller
{
	public $dir_view;
	public static $template = __DIR__ . '/../../app/template/default/index.php';
	
	public function renderAjax($view, $params = [])
	{
		extract($params);
        $name_view = $this->getNameView();
	    include __DIR__ . '/../../app/views/' . $name_view . '/' . $view . '.php';
	}
	
	/**
     * The main method of page formation
	 * @param $view
	 */
	public function render($view, $params = [])
	{
		extract($params);
        $name_view = $this->getNameView();
	    ob_start();
		include __DIR__ . '/../../app/views/' . $name_view . '/' . $view . '.php';
		$content = ob_get_contents();
		ob_end_clean();
		include self::$template;
	}
	
	public function redirect($target)
    {
        header('Location:' . App::$root . $target);
    }
    
    private function getNameView()
    {
        $name_class = get_called_class();
        $name_class = strtolower($name_class);
        $name_view = str_replace('controllers\\', '', $name_class);
        $name_view = str_replace('controller', '', $name_view);
        
        return $name_view;
    }
	
}
