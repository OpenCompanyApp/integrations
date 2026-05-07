<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Update User.
 */
class FireworksAiUpdateUser extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_update_user';
    protected const DESCRIPTION = 'Update User.';
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1/accounts/{account_id}/users/{user_id}';
    protected const PATH_PARAMS = ['account_id', 'user_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'user_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks user_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Fireworks AI API schema.']];
}
