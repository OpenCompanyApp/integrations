<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Get Model Download Endpoint.
 */
class FireworksAiGetModelDownloadEndpoint extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_get_model_download_endpoint';
    protected const DESCRIPTION = 'Get Model Download Endpoint.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/accounts/{account_id}/models/{model_id}:getDownloadEndpoint';
    protected const PATH_PARAMS = ['account_id', 'model_id'];
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'model_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks model_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
