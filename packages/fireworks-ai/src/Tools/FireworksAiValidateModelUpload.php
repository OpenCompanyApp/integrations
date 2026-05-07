<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Validate Model Upload.
 */
class FireworksAiValidateModelUpload extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_validate_model_upload';
    protected const DESCRIPTION = 'Validate Model Upload.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/accounts/{account_id}/models/{model_id}:validateUpload';
    protected const PATH_PARAMS = ['account_id', 'model_id'];
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'model_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks model_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
