<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Cancel Reinforcement Fine-tuning Job.
 */
class FireworksAiCancelReinforcementFineTuningJob extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_cancel_reinforcement_fine_tuning_job';
    protected const DESCRIPTION = 'Cancel Reinforcement Fine-tuning Job.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/accounts/{account_id}/reinforcementFineTuningJobs/{reinforcement_fine_tuning_job_id}:cancel';
    protected const PATH_PARAMS = ['account_id', 'reinforcement_fine_tuning_job_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'reinforcement_fine_tuning_job_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks reinforcement_fine_tuning_job_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Fireworks AI API schema.']];
}
