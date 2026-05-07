<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Create a Mistral fine-tuning job.
 */
class MistralCreateFineTuningJob extends AbstractMistralTool
{
    protected const NAME = 'mistral_create_fine_tuning_job';
    protected const DESCRIPTION = 'Create a Mistral fine-tuning job.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/fine_tuning/jobs';
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['body' => ['type' => 'object', 'required' => true, 'description' => 'Fine-tuning job create body matching the Mistral API schema.']];
}
