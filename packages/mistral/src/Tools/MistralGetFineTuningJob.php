<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Retrieve a Mistral fine-tuning job.
 */
class MistralGetFineTuningJob extends AbstractMistralTool
{
    protected const NAME = 'mistral_get_fine_tuning_job';
    protected const DESCRIPTION = 'Get a Mistral fine-tuning job by job_id.';
    protected const PATH = '/v1/fine_tuning/jobs/{job_id}';
    protected const PATH_PARAMS = ['job_id'];
    protected const PARAMETERS = ['job_id' => ['type' => 'string', 'required' => true, 'description' => 'Fine-tuning job ID.']];
}
