<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Update LoRA.
 */
class FireworksAiUpdateDeployedModel extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_update_deployed_model';
    protected const DESCRIPTION = 'Update LoRA.';
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1/accounts/{account_id}/deployedModels/{deployed_model_id}';
    protected const PATH_PARAMS = ['account_id', 'deployed_model_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'deployed_model_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks deployed_model_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Fireworks AI API schema.']];
}
