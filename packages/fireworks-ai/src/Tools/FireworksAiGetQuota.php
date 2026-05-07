<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Get Quota.
 */
class FireworksAiGetQuota extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_get_quota';
    protected const DESCRIPTION = 'Get Quota.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/accounts/{account_id}/quotas/{quota_id}';
    protected const PATH_PARAMS = ['account_id', 'quota_id'];
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'quota_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks quota_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
