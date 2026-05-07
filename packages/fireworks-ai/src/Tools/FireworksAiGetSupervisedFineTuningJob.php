<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Get Supervised Fine-tuning Job.
 */
class FireworksAiGetSupervisedFineTuningJob extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_get_supervised_fine_tuning_job';
    protected const DESCRIPTION = 'Get Supervised Fine-tuning Job.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/accounts/{account_id}/supervisedFineTuningJobs/{supervised_fine_tuning_job_id}';
    protected const PATH_PARAMS = ['account_id', 'supervised_fine_tuning_job_id'];
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'supervised_fine_tuning_job_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks supervised_fine_tuning_job_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
