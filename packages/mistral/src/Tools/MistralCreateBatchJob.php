<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Create a Mistral batch job.
 */
class MistralCreateBatchJob extends AbstractMistralTool
{
    protected const NAME = 'mistral_create_batch_job';
    protected const DESCRIPTION = 'Create a Mistral batch job.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/batch/jobs';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['body' => ['type' => 'object', 'required' => true, 'description' => 'Batch job create body with input files, endpoint, model, and metadata.']];
}
