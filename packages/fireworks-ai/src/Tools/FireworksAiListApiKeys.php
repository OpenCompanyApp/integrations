<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * List API Keys.
 */
class FireworksAiListApiKeys extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_list_api_keys';
    protected const DESCRIPTION = 'List API Keys.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/accounts/{account_id}/users/{user_id}/apiKeys';
    protected const PATH_PARAMS = ['account_id', 'user_id'];
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'user_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks user_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
