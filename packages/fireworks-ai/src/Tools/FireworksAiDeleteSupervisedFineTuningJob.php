<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Delete Supervised Fine-tuning Job.
 */
class FireworksAiDeleteSupervisedFineTuningJob extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_delete_supervised_fine_tuning_job';
    protected const DESCRIPTION = 'Delete Supervised Fine-tuning Job.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/accounts/{account_id}/supervisedFineTuningJobs/{supervised_fine_tuning_job_id}';
    protected const PATH_PARAMS = ['account_id', 'supervised_fine_tuning_job_id'];
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'supervised_fine_tuning_job_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks supervised_fine_tuning_job_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
