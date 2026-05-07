<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Start a Mistral fine-tuning job.
 */
class MistralStartFineTuningJob extends AbstractMistralTool
{
    protected const NAME = 'mistral_start_fine_tuning_job';
    protected const DESCRIPTION = 'Start a Mistral fine-tuning job.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/fine_tuning/jobs/{job_id}/start';
    protected const PATH_PARAMS = ['job_id'];
    protected const PARAMETERS = ['job_id' => ['type' => 'string', 'required' => true, 'description' => 'Fine-tuning job ID.']];
}
