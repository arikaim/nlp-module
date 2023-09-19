<?php
/**
 * Arikaim
 *
 * @link        http://www.arikaim.com
 * @copyright   Copyright (c)  Konstantin Atanasov <info@arikaim.com>
 * @license     http://www.arikaim.com/license
 * 
*/
namespace Arikaim\Modules\Nlp\Drivers;

use Arikaim\Core\Arikaim;
use Arikaim\Modules\Api\AbstractApiClient;
use Arikaim\Core\Driver\Traits\Driver;
use Arikaim\Core\Interfaces\Driver\DriverInterface;
use Arikaim\Modules\Api\Interfaces\ApiClientInterface;
use Arikaim\Modules\Nlp\Interfaces\TextGenerationInterface;

/**
 * Huggingface api driver class
 */
class HuggingfaceDriver extends AbstractApiClient implements 
    DriverInterface, 
    ApiClientInterface,
    TextGenerationInterface
{   
    use Driver;

    /**
     * Api key
     *
     * @var string
     */
    protected $apiKey = '';

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setDriverParams('huggingface','ai-nlp','Huggingface','Huggingface.co Api driver');      
    }

    /**
     * Initialize driver
     *
     * @return void
     */
    public function initDriver($properties)
    {
        $this->setBaseUrl('https://api-inference.huggingface.co/models/');    
        $this->apiKey = $properties->getValue('api_key');     
        $this->setFunctionsNamespace('Arikaim\\Modules\\Nlp\\Functions\\Huggingface\\');  
    }

    /**
     * Generate text
     *
     * @param string $input
     * @param array|null $options
     * @return string|null|array
     */
    public function generateText(string $input, ?array $options = null)
    {   
        $params = [
            'model' => $options['model'] ?? 'gpt2'
        ];
        $postFields['inputs'] = $input;
        $postFields = (\is_array($options) == true) ? \array_merge($postFields,$options) : $postFields;
        $apiResponse = $this->call('TextGeneration',$params,$postFields);
        if ($apiResponse->hasError() == true) {
            return null;
        }
        $data = $apiResponse->toArray();
     
        foreach($data as $item) {
            $items[] = $item['generated_text'] ?? null;
        }

        return $items;     
    }

    /**
     * Get authorization header or false if api not uses header for auth
     *
     * @param array|null $params
     * @return array|null
    */
    public function getAuthHeaders(?array $params = null): ?array
    {
        return [
            'Authorization: Bearer ' . $this->apiKey
        ];       
    }

    /**
     * Create driver config properties array
     *
     * @param Arikaim\Core\Collection\Properties $properties
     * @return void
     */
    public function createDriverConfig($properties)
    { 
        $properties->property('api_key',function($property) {
            $property
                ->title('Api Key')
                ->type('text')     
                ->required(true)  
                ->value('');                         
        }); 
    }
}
