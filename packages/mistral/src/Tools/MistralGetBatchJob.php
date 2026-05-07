<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Retrieve a Mistral batch job.
 */
class MistralGetBatchJob extends AbstractMistralTool
{
    protected const NAME = 'mistral_get_batch_job';
    protected const DESCRIPTION = 'Get a Mistral batch job by job_id.';
    protected const PATH = '/v1/batch/jobs/{job_id}';
    protected const PATH_PARAMS = ['job_id'];
    protected const PARAMETERS = ['job_id' => ['type' => 'string', 'required' => true, 'description' => 'Batch job ID.']];
}
