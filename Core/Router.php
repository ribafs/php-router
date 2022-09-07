<?php
namespace Core;

class Router
{
    // Properties relatives to url
    private $urlController = null;
    private $urlAction = null;
    private $urlParams = array();
    
    // See that all the code is inside constructor, which means that when you create an instance of this class all your code is already in action
    public function __construct(){
        
        // Verify if url isset
        if (isset($_GET['url'])) {
            // Split URL in parts
            $url = trim($_GET['url'], '/'); 
            $url = filter_var($url, FILTER_SANITIZE_URL); // Filter the url from characters foreign to a url
            $url = explode('/', $url); // Create array with: controller/action/params
            
            // controller, action e parameters
            $this->urlController = isset($url[0]) ? $url[0] : null; // Create $this->urlController with $url[0]
            $this->urlAction = isset($url[1]) ? $url[1] : null; // Create $this->urlAction with $url[1]            
            unset($url[0], $url[1]);// Clear $url[0] and $url[1]
            $this->urlParams = array_values($url); // Create $this->urlParams with array_values($url)            
        }
        
        // If the controller is not passed by the URL, then the controller customers will be assumed as default, with the action index
        if (!isset($this->urlController)) {
            $ctrl = new \App\Controllers\CustomersController;
            $ctrl->index();
            
        }elseif ($this->urlController == 'customers'){                  				                    
            // Let's see if no action was passed or if index was passed, assume index
            if(!isset($this->urlAction) || $this->urlAction == 'index'){
                $ctrl = new \App\Controllers\CustomersController;
                $ctrl->index();
                // If passed add action
                
            }elseif ($this->urlAction == 'add'){	
                $ctrl = new \App\Controllers\CustomersController;
                $ctrl->add();
                // If passed edit action, delete or update		            
                
            }elseif ($this->urlAction == 'edit' || $this->urlAction == 'delete' || $this->urlAction == 'update'){	
                $controller = new \App\Controllers\CustomersController;
                $this->urlController = new $controller();				
                $this->urlController->{$this->urlAction}(...$this->urlParams);
                // If none of the above is passed, show the error to the user
                
            }else{
                $error = new \Core\ErrorController();
                // Pass to the ErrorController, which will pass to the index view
                $error->index();				
            }
        }else{
            $error = new \Core\ErrorController();
            $error->index();				
        }
    }		   
}
