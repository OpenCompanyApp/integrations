<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Resume Rlor Trainer Job.
 */
class FireworksAiResumeReinforcementFineTuningStep extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_resume_reinforcement_fine_tuning_step';
    protected const DESCRIPTION = 'Resume Rlor Trainer Job.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/accounts/{account_id}/rlorTrainerJobs/{rlor_trainer_job_id}:resume';
    protected const PATH_PARAMS = ['account_id', 'rlor_trainer_job_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'rlor_trainer_job_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks rlor_trainer_job_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Fireworks AI API schema.']];
}
