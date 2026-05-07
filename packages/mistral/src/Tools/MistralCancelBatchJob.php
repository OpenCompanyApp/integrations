<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Cancel a Mistral batch job.
 */
class MistralCancelBatchJob extends AbstractMistralTool
{
    protected const NAME = 'mistral_cancel_batch_job';
    protected const DESCRIPTION = 'Cancel a Mistral batch job.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/batch/jobs/{job_id}/cancel';
    protected const PATH_PARAMS = ['job_id'];
    protected const PARAMETERS = ['job_id' => ['type' => 'string', 'required' => true, 'description' => 'Batch job ID.']];
}
