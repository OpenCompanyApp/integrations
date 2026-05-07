<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Get Reinforcement Fine-tuning Step.
 */
class FireworksAiGetReinforcementFineTuningStep extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_get_reinforcement_fine_tuning_step';
    protected const DESCRIPTION = 'Get Reinforcement Fine-tuning Step.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/accounts/{account_id}/rlorTrainerJobs/{rlor_trainer_job_id}';
    protected const PATH_PARAMS = ['account_id', 'rlor_trainer_job_id'];
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'rlor_trainer_job_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks rlor_trainer_job_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
