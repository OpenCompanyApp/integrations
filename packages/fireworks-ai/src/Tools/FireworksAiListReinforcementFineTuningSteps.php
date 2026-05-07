<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * List Reinforcement Fine-tuning Steps.
 */
class FireworksAiListReinforcementFineTuningSteps extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_list_reinforcement_fine_tuning_steps';
    protected const DESCRIPTION = 'List Reinforcement Fine-tuning Steps.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/accounts/{account_id}/rlorTrainerJobs';
    protected const PATH_PARAMS = ['account_id'];
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
