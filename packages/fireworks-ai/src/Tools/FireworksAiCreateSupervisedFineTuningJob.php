<?php

namespace OpenCompany\Integrations\FireworksAi\Tools;

/**
 * Create Supervised Fine-tuning Job.
 */
class FireworksAiCreateSupervisedFineTuningJob extends AbstractFireworksAiTool
{
    protected const NAME = 'fireworks_ai_create_supervised_fine_tuning_job';
    protected const DESCRIPTION = 'Create Supervised Fine-tuning Job.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/accounts/{account_id}/supervisedFineTuningJobs';
    protected const PATH_PARAMS = ['account_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['account_id' => ['type' => 'string', 'required' => true, 'description' => 'Fireworks account_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Fireworks AI API schema.']];
}
