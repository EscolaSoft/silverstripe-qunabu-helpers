<?php
/**
 * Created by PhpStorm.
 * User: qunabu
 * Date: 06.07.17
 * Time: 10:35
 */

use SilverStripe\ORM\DataExtension;
use SilverStripe\ORM\ArrayList;
use SilverStripe\View\SSViewer;
use SilverStripe\Control\Director;

class PageHelperExtension extends DataExtension {
    
  public function isDev() {
    return Director::get_environment_type() == 'dev';
  }
    
  public function isLive() {
    return Director::get_environment_type() == 'live';
  }
    
  public function getJavaScriptLibFiles() {

    $themes = SSViewer::get_themes();
    $ThemeDir = $themes[0];
  
    $files = glob( BASE_PATH.'/themes/'. $ThemeDir .'/javascript/lib/*.js' );
    
    usort($files, function($a, $b) {
      return strnatcasecmp($a, $b);
    });
    
    $result = new ArrayList();
    foreach($files as $file) {
      $result->push(array(
        'File'=>basename($file)
      ));
    }

    return $result;

  }
    
  public function getThemeDir() {

    $ss = SSViewer::get_themes();    
    return 'themes/'.$ss[0];

  }
}
