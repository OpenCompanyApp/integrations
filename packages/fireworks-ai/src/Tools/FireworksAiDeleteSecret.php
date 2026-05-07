<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Delete secret.
 */
class FireworksAiDeleteSecret extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_delete_secret';
    protected const DESCRIPTION = 'Delete secret.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/accounts/{account_id}/secrets/{secret_id}';
    protected const PATH_PARAMS = ['account_id', 'secret_id'];
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'secret_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks secret_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
