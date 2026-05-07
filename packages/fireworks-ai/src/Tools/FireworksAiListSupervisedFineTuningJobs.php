<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * List Supervised Fine-tuning Jobs.
 */
class FireworksAiListSupervisedFineTuningJobs extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_list_supervised_fine_tuning_jobs';
    protected const DESCRIPTION = 'List Supervised Fine-tuning Jobs.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/accounts/{account_id}/supervisedFineTuningJobs';
    protected const PATH_PARAMS = ['account_id'];
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
