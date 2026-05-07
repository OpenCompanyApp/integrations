<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Resume Dpo Job.
 */
class FireworksAiResumeDpoJob extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_resume_dpo_job';
    protected const DESCRIPTION = 'Resume Dpo Job.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/accounts/{account_id}/dpoJobs/{dpo_job_id}:resume';
    protected const PATH_PARAMS = ['account_id', 'dpo_job_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'dpo_job_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks dpo_job_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Fireworks AI API schema.']];
}
