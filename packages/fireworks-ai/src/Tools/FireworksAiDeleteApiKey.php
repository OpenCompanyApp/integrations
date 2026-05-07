<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Delete API Key.
 */
class FireworksAiDeleteApiKey extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_delete_api_key';
    protected const DESCRIPTION = 'Delete API Key.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/accounts/{account_id}/users/{user_id}/apiKeys:delete';
    protected const PATH_PARAMS = ['account_id', 'user_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'user_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks user_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Fireworks AI API schema.']];
}
