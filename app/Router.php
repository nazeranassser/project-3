<?php 

namespace App;
// require_once ('controllers/admins-controllers.php');
use App\Controllers\AdminsController;
use App\Controllers\CartsController;


class Router {
    protected $routes = [];
    protected $params = [];

    // Add a route to the routing table
    public function add($route, $params = []) {
        // Convert the route to a regular expression: escape forward slashes
        $route = preg_replace('/\//', '\\/', $route);
        
        // Convert variables e.g. {id:\d+}
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);
        
        // Add start and end delimiters, and case insensitive flag
        $route = '/^' . $route . '$/i';
        
        $this->routes[$route] = $params;
    }
    

    // Get all routes from the routing table
    public function getRoutes() {
        return $this->routes;
    }

    // Match the route to the URL path
    public function match($url) {
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $params[$key] = $match;
                    }
                }
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    // Get the parameters (controller, action, etc.)
    public function getParams() {
        return $this->params;
    }

    public function dispatch($url) {
        // Remove query string variables from the URL
        $url = $this->removeQueryStringVariables($url);
    
        if ($this->match($url)) {
            // Get the controller class name
            $controller = $this->params['controller'];
            $controller = $this->convertToStudlyCaps($controller);
    
            // Append 'Controller' only if not present
            if (substr($controller, -10) !== 'Controller') {
                $controller .= 'Controller';
            }
    
            // Fully qualified class name
            $controller = $this->getNamespace() . $controller;
    
            // Check if controller class exists
            if (class_exists($controller)) {
                $controller_object = new $controller($this->params);
    
                // Convert action to camelCase
                $action = $this->params['action'];
                $action = $this->convertToCamelCase($action);
    
                // Check if the method (action) exists and is callable
                if (is_callable([$controller_object, $action])) {
                    // Pass URL parameters (like `id`) to the action method
                    if(isset($this->params['id'])){
                        $data[] = $this->params['id'];
                    }else{
                        $data[] = $this->params;
                    }
                   
                    call_user_func_array([$controller_object, $action], array_values($data));
                } else {
                    throw new \Exception("Method $action in controller $controller cannot be called.");
                }
            } else {
                throw new \Exception("Controller class $controller not found.");
            }
        } else {
            // throw new \Exception("No route matched.", 404);
            require 'views/pages/404.php';
        }
    }

    // Convert the string to StudlyCaps (e.g., post-new => PostNew)
    protected function convertToStudlyCaps($string) {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }

    // Convert the string to camelCase (e.g., add-new => addNew)
    protected function convertToCamelCase($string) {
        return lcfirst($this->convertToStudlyCaps($string));
    }

    // Remove the query string variables (if any)
    protected function removeQueryStringVariables($url) {
        if ($url != '') {
            $parts = explode('&', $url, 2);
            if (strpos($parts[0], '=') === false) {
                $url = $parts[0];
            } else {
                $url = '';
            }
        }
        return $url;
    }

    // Get the namespace for the controller class
    protected function getNamespace() {
        $namespace = 'App\Controllers\\';

        if (array_key_exists('namespace', $this->params)) {
            $namespace .= $this->params['namespace'] . '\\';
        }

        return $namespace;
    }
}

// class Router {
//     protected $routes = [];
//     protected $params = [];

//     // Add a route to the routing table
//     public function add($route, $params = []) {
//         // Convert the route to a regular expression
//         $route = preg_replace('/\//', '\\/', $route);
//         $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);
//         $route = preg_replace('/\{([a-z]+)\:\d+\}/', '(?P<\1>\d+)', $route);
//         // $route = '/^' . $route . '$/i';

//         $this->routes[$route] = $params;
//     }

//     // Match the route to the URL path
//     public function match($url) {
//         var_dump($this->routes);
//         foreach ($this->routes as $route => $params) {
//             // $url = '/'.$url.'/i';
//             echo preg_match($route , $url);
//             echo "<br>////////////////////////////////////////////<br>";
//             var_dump($url);
//             echo "<br>////////////////////////////////////////////<br>";

//             // if (preg_match($route, $url, $matches)) {
//             //     foreach ($matches as $key => $match) {
//             //         if (is_string($key)) {
//             //             $params[$key] = $match; // Capture named parameters
//             //         }
//             //     }
//             //     $this->params = $params;
//             //     return true; // Match found
//             // }
//         }
//         return false; // No match found
//     }

//     // Dispatch the route by creating the controller and calling the method (action)
//     public function dispatch($url) {
//         // Define the base directory (the path relative to the web server)
//         $baseDir = '/hhhh/cakeProject'; // This should match the URL structure
//         // Strip the base directory from the URL
//         if (strpos($url, $baseDir) === 0) {
//             $url = substr($url, strlen($baseDir)); // Remove base path
//         }
    
//         // Remove leading slashes
//         $url = ltrim($url, '/');
    
//         // Remove query string variables from the URL
//         $url = $this->removeQueryStringVariables($url);
//         echo "Dispatching URL: " . htmlspecialchars($url) . "<br>"; // Debug output
        
//         if ($this->match($url)) {
//             // existing dispatch code...
//         } else {
//             throw new \Exception("No route matched.", 404);
//         }
//     }
    
    

//     // Remove the query string variables (if any)
//     protected function removeQueryStringVariables($url) {
//         if ($url != '') {
//             $parts = explode('?', $url, 2); // Correctly split on "?"
//             return $parts[0]; // Return the part before "?", ignore query string
//         }
//         return $url;
//     }
    


//     // Convert the string to StudlyCaps (e.g., post-new => PostNew)
//     protected function convertToStudlyCaps($string) {
//         return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
//     }

//     // Convert the string to camelCase (e.g., add-new => addNew)
//     protected function convertToCamelCase($string) {
//         return lcfirst($this->convertToStudlyCaps($string));
//     }

//     // Get the namespace for the controller class
//     protected function getNamespace() {
//         $namespace = 'App\Controllers\\';

//         if (array_key_exists('namespace', $this->params)) {
//             $namespace .= $this->params['namespace'] . '\\';
//         }

//         return $namespace;
//     }
// }
