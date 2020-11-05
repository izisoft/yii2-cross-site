<?php 
namespace izi\cross;
use Yii;

class View extends \yii\web\View
{    
    
    /**
     * Render partial file
     */
    public function renderPartial($_partial_, $_params_ = []){
                
        // render partial theme if exist
        
        $path = $this->theme->getPath('partials');
   
        $partialFile = $path . DIRECTORY_SEPARATOR . trim($_partial_, DIRECTORY_SEPARATOR) . '.php';
        
        if(file_exists($partialFile)){
            return $this->renderPhpFile($partialFile, $_params_ );
        }else{

            // render partial view if exist
            
            $path = Yii::$app->viewPath . DIRECTORY_SEPARATOR . 'partials';
        
            $partialFile = $path . DIRECTORY_SEPARATOR . trim($_partial_, DIRECTORY_SEPARATOR) . '.php';
        
            if(file_exists($partialFile)){
                return $this->renderPhpFile($partialFile, $_params_ );
            }
        }
    }
}