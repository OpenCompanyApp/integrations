<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Prepare Model for different precisions.
 */
class FireworksAiPrepareModel extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_prepare_model';
    protected const DESCRIPTION = 'Prepare Model for different precisions.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/accounts/{account_id}/models/{model_id}:prepare';
    protected const PATH_PARAMS = ['account_id', 'model_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'model_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks model_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Fireworks AI API schema.']];
}
