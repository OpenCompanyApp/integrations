<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Get LoRA.
 */
class FireworksAiGetDeployedModel extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_get_deployed_model';
    protected const DESCRIPTION = 'Get LoRA.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/accounts/{account_id}/deployedModels/{deployed_model_id}';
    protected const PATH_PARAMS = ['account_id', 'deployed_model_id'];
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'deployed_model_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks deployed_model_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
