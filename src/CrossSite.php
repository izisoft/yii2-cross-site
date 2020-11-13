<?php
namespace izi\cross;

use Yii;

class CrossSite extends \yii\base\Component
{
   
    private $_curl;
    
    private $_token, $_domain, $_api_url;
    
    public function init(){
        
        $this->_api_url = implode('/', [Yii::$app->params['api_site_url'],'api',Yii::$app->params['api_version']]);    
        
        $this->_domain = $_SERVER['HTTP_HOST'];
        
        $this->_token = Yii::$app->params['access_token'];
                
    }
    
    /**
     * Get logo
     */

    public function getLogo($code = 'main')
    {
        $api_url = implode('/', [$this->_api_url , 'sweb/logo']);
        // create curl object
        $curl = new CurlPost($api_url);
        
        $menu = $curl([
            'code' => $code,
            'domain' => $this->_domain,
            'access_token'   => $this->_token,
        ]);
        
        return json_decode($menu,1);        
    }


    /**
     * Get ADV
     */

    public function getAdvert($code)
    {
        $api_url = implode('/', [$this->_api_url , 'sweb/advert']);
        // create curl object
        $curl = new CurlPost($api_url);
        
        $menu = $curl([
            'code' => $code,
            'domain' => $this->_domain,
            'access_token'   => $this->_token,
        ]);
        
        return json_decode($menu,1);        
    }

    /**
     * Get Widgets
     */

    public function getWidgets($code)
    {
        $api_url = implode('/', [$this->_api_url , 'sweb/widgets']);
        // create curl object
        $curl = new CurlPost($api_url);
        
        $menu = $curl([
            'code' => $code,
            'domain' => $this->_domain,
            'access_token'   => $this->_token,
        ]);
        
        return json_decode($menu,1);        
    }


    /**
     * Get Widgets
     */

    public function getWidget($code, $params = [])
    {
        $api_url = implode('/', [$this->_api_url , 'sweb/widget']);
        // create curl object
        $curl = new CurlPost($api_url);
        
        $menu = $curl([
            'code' => $code,
            'domain' => $this->_domain,
            'access_token'   => $this->_token,
        ]);

        $menu = json_decode($menu,1);

        if(isset($menu['error']) && $menu['error']==1 && isset($params['default']) && !empty($params['default'])){
            return array_merge([

            ],
            $params['default']);
        }
        
        return $menu;     
    }
    

    /**
     * Menu
     */
    
    public function getMenu($code)
    {
        $api_url = implode('/', [$this->_api_url , 'sweb/menu']);
        // create curl object
        $curl = new CurlPost($api_url);
        
        $menu = $curl([
            'code' => $code,
            'domain' => $this->_domain,
            'access_token'   => $this->_token,
        ]);
        
        return json_decode($menu,1);        
    }
    
    public function getCategoryDetail($url)
    {
        $api_url = implode('/', [$this->_api_url , 'sweb/detail']);
        // create curl object
        $curl = new CurlPost($api_url);
        
        $menu = $curl([
            'url' => $url,
            'domain' => $this->_domain,
            'access_token'   => $this->_token,
        ]);
        
        return json_decode($menu,1); 
    }
    
    
    public function getBreadcrumb($url)
    {
        $api_url = implode('/', [$this->_api_url , 'category/breadcrumb']);
        // create curl object
        $curl = new CurlPost($api_url);
        
        $menu = $curl([
            'url' => $url,
            'domain' => $this->_domain,
            'access_token'   => $this->_token,
        ]);
        
        return json_decode($menu,1);
    }
    

}
