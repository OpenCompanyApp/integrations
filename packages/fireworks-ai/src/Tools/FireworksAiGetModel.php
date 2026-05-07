<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Get Model.
 */
class FireworksAiGetModel extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_get_model';
    protected const DESCRIPTION = 'Get Model.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/accounts/{account_id}/models/{model_id}';
    protected const PATH_PARAMS = ['account_id', 'model_id'];
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'model_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks model_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
