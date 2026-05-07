<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Delete Reinforcement Fine-tuning Step.
 */
class FireworksAiDeleteReinforcementFineTuningStep extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_delete_reinforcement_fine_tuning_step';
    protected const DESCRIPTION = 'Delete Reinforcement Fine-tuning Step.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/accounts/{account_id}/rlorTrainerJobs/{rlor_trainer_job_id}';
    protected const PATH_PARAMS = ['account_id', 'rlor_trainer_job_id'];
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'rlor_trainer_job_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks rlor_trainer_job_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
