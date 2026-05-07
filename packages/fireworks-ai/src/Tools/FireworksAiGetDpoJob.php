<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Get dpo job.
 */
class FireworksAiGetDpoJob extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_get_dpo_job';
    protected const DESCRIPTION = 'Get dpo job.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/accounts/{account_id}/dpoJobs/{dpo_job_id}';
    protected const PATH_PARAMS = ['account_id', 'dpo_job_id'];
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'dpo_job_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks dpo_job_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
