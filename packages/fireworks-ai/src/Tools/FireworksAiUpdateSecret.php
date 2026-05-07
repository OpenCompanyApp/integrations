<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Update secret.
 */
class FireworksAiUpdateSecret extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_update_secret';
    protected const DESCRIPTION = 'Update secret.';
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1/accounts/{account_id}/secrets/{secret_id}';
    protected const PATH_PARAMS = ['account_id', 'secret_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'secret_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks secret_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Fireworks AI API schema.']];
}
