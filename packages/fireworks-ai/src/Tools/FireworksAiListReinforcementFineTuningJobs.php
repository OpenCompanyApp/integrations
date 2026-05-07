<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * List Reinforcement Fine-tuning Jobs.
 */
class FireworksAiListReinforcementFineTuningJobs extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_list_reinforcement_fine_tuning_jobs';
    protected const DESCRIPTION = 'List Reinforcement Fine-tuning Jobs.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/accounts/{account_id}/reinforcementFineTuningJobs';
    protected const PATH_PARAMS = ['account_id'];
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
