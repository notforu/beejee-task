<?php
    
class Router{
	private $routes;
	
	public function __construct()
	{
		$routesPath = ROOT."/config/routes.php";
		$this->routes = include($routesPath);
	}
	
	private function getURI()
	{
		$uri = $_SERVER['REQUEST_URI'];
		if (!empty($uri)){
			return trim($uri,'/');
		}
		else{
			return '';
		}
	}
	
	public function run(){
		
		$uri = $this->getURI();
		
		foreach($this->routes as $uriPattern => $path){
			//echo "<br>$path $uri $uriPattern";
			if (preg_match("~$uriPattern~", $uri)){
				
				//echo "P: $uriPattern  U: $uri";
				//get internal route acconding the rule
				$internalRoute = preg_replace("~$uriPattern~", $path, $uri);
				
				//determine which controller and action handle the request
				$segments = explode('/', $internalRoute);
				
				$controllerName = array_shift($segments).'Controller';
				$controllerName = ucfirst($controllerName);
				
				$actionName = 'action'.ucfirst(array_shift($segments));
				$parameters = $segments;
				
				//include controller file
				$controllerFile = ROOT . '/controllers/' . $controllerName . '.php';
				
				if (file_exists($controllerFile)){
					include_once($controllerFile);
				}
				
				//create controller object and run
				$controllerObject = new $controllerName;
				$result = call_user_func_array(array($controllerObject, $actionName), $parameters);
				
				//if we have found controller and action, break the loop
				if ($result){
					break;
				}
				
			}
		}

	}
}
