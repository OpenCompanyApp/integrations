<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Get Model Upload Endpoint.
 */
class FireworksAiGetModelUploadEndpoint extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_get_model_upload_endpoint';
    protected const DESCRIPTION = 'Get Model Upload Endpoint.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/accounts/{account_id}/models/{model_id}:getUploadEndpoint';
    protected const PATH_PARAMS = ['account_id', 'model_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'model_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks model_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Fireworks AI API schema.']];
}
