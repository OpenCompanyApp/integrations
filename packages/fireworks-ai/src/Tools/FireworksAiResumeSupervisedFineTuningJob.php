<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Resume Supervised Fine-tuning Job.
 */
class FireworksAiResumeSupervisedFineTuningJob extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_resume_supervised_fine_tuning_job';
    protected const DESCRIPTION = 'Resume Supervised Fine-tuning Job.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/accounts/{account_id}/supervisedFineTuningJobs/{supervised_fine_tuning_job_id}:resume';
    protected const PATH_PARAMS = ['account_id', 'supervised_fine_tuning_job_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'supervised_fine_tuning_job_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks supervised_fine_tuning_job_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Fireworks AI API schema.']];
}
