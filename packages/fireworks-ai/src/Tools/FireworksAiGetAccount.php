<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Get Account.
 */
class FireworksAiGetAccount extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_get_account';
    protected const DESCRIPTION = 'Get Account.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/accounts/{account_id}';
    protected const PATH_PARAMS = ['account_id'];
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
