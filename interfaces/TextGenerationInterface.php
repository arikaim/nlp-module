<?php
/**
 * Arikaim
 *
 * @link        http://www.arikaim.com
 * @copyright   Copyright (c)  Konstantin Atanasov <info@arikaim.com>
 * @license     http://www.arikaim.com/license
 * 
*/
namespace Arikaim\Modules\Nlp\Interfaces;

use Arikaim\Modules\Api\AbstractApiFunction;
use Arikaim\Modules\Api\Interfaces\ApiFunctionInterface;

/**
 * Text generation interface
 */
interface TextGenerationInterface 
{
    /**
     * Generate text
     *
     * @param string $input
     * @param array|null $options
     * @return string|null
     */
    public function generateText(string $input, ?array $options = null): ?string;
}
