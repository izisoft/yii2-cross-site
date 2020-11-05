<?php 

namespace izi\cross;

use Yii;
 

class UrlManager extends \yii\web\UrlManager
{
    
    public function parseUrl()
    {
        $url = trim(Yii::$app->request->url,'/');
        
        $api_url = implode('/', [Yii::$app->params['api_site_url'],'api',Yii::$app->params['api_version'] , 'request']);
        
        // create curl object
        $curl = new CurlPost($api_url);
                 
        try {
            // execute the request
            return $curl([
                'url' => $url,
                'domain' => $_SERVER['HTTP_HOST'],
                'access_token'   => Yii::$app->params['access_token'],
            ]);
        } catch (\RuntimeException $ex) {
            // catch errors
            die(sprintf('Http error %s with code %d', $ex->getMessage(), $ex->getCode()));
        }
    }
    
    public function parseRequest($request)
    {
        
        $url_info = json_decode($this->parseUrl(),1);
          
        
        if(!(isset($url_info['error']) && $url_info['error'] == 1)){                        
        
            Yii::$app->request->setUrl(implode('/', [$url_info['controller'], $url_info['action']]));
            
            Yii::$app->params['item'] = $url_info['item'];
        
        }
        $rq = parent::parseRequest($request);
                
        return $rq;
    }
    
}