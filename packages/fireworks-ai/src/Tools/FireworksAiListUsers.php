<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * List Users.
 */
class FireworksAiListUsers extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_list_users';
    protected const DESCRIPTION = 'List Users.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/accounts/{account_id}/users';
    protected const PATH_PARAMS = ['account_id'];
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
