<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * List LoRAs.
 */
class FireworksAiListDeployedModels extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_list_deployed_models';
    protected const DESCRIPTION = 'List LoRAs.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/accounts/{account_id}/deployedModels';
    protected const PATH_PARAMS = ['account_id'];
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
