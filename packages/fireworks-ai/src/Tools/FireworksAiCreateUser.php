<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Create User.
 */
class FireworksAiCreateUser extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_create_user';
    protected const DESCRIPTION = 'Create User.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/accounts/{account_id}/users';
    protected const PATH_PARAMS = ['account_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Fireworks AI API schema.']];
}
