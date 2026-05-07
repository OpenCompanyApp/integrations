<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * List Models.
 */
class FireworksAiListModels extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_list_models';
    protected const DESCRIPTION = 'List Models.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/accounts/{account_id}/models';
    protected const PATH_PARAMS = ['account_id'];
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
