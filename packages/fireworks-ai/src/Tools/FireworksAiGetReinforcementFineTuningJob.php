<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Get Reinforcement Fine-tuning Job.
 */
class FireworksAiGetReinforcementFineTuningJob extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_get_reinforcement_fine_tuning_job';
    protected const DESCRIPTION = 'Get Reinforcement Fine-tuning Job.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/accounts/{account_id}/reinforcementFineTuningJobs/{reinforcement_fine_tuning_job_id}';
    protected const PATH_PARAMS = ['account_id', 'reinforcement_fine_tuning_job_id'];
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'reinforcement_fine_tuning_job_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks reinforcement_fine_tuning_job_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
