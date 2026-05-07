<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Update Quota.
 */
class FireworksAiUpdateQuota extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_update_quota';
    protected const DESCRIPTION = 'Update Quota.';
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1/accounts/{account_id}/quotas/{quota_id}';
    protected const PATH_PARAMS = ['account_id', 'quota_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'quota_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks quota_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Fireworks AI API schema.']];
}
