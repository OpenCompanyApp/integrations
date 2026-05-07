<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Load LoRA.
 */
class FireworksAiCreateDeployedModel extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_create_deployed_model';
    protected const DESCRIPTION = 'Load LoRA.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/accounts/{account_id}/deployedModels';
    protected const PATH_PARAMS = ['account_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Fireworks AI API schema.']];
}
