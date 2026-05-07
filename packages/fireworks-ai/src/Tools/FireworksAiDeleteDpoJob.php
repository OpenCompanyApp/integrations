<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Delete dpo job.
 */
class FireworksAiDeleteDpoJob extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_delete_dpo_job';
    protected const DESCRIPTION = 'Delete dpo job.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/accounts/{account_id}/dpoJobs/{dpo_job_id}';
    protected const PATH_PARAMS = ['account_id', 'dpo_job_id'];
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'dpo_job_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks dpo_job_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
