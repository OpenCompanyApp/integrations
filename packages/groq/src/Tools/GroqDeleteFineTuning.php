<?php

namespace OpenCompany\Integrations\Groq\Tools;

/**
 * Delete a Groq fine-tuning job.
 */
class GroqDeleteFineTuning extends AbstractGroqTool
{
    protected const NAME = 'groq_delete_fine_tuning';
    protected const DESCRIPTION = 'Delete a Groq fine-tuning job by ID.';
    protected const METHOD = 'deleteFineTuning';
    protected const ARGUMENTS = ['id'];
    protected const REQUIRED = ['id'];
}
