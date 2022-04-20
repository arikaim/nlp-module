<?php
/**
 * Arikaim
 *
 * @link        http://www.arikaim.com
 * @copyright   Copyright (c)  Konstantin Atanasov <info@arikaim.com>
 * @license     http://www.arikaim.com/license
 * 
*/
namespace Arikaim\Modules\Nlp;

use Arikaim\Core\Extension\Module;

/**
 * Nlp module class
 */
class Nlp extends Module
{  
    /**
     * Install module
     *
     * @return void
     */
    public function install()
    {
        $this->installDriver('Arikaim\\Modules\\Nlp\\Drivers\\HuggingfaceDriver');        
    }
}
