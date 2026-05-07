<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * List Quotas.
 */
class FireworksAiListQuotas extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_list_quotas';
    protected const DESCRIPTION = 'List Quotas.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/accounts/{account_id}/quotas';
    protected const PATH_PARAMS = ['account_id'];
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
