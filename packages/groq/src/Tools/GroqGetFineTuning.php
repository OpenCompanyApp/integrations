<?php

namespace OpenCompany\Integrations\Groq\Tools;

/**
 * Retrieve a Groq fine-tuning job.
 */
class GroqGetFineTuning extends AbstractGroqTool
{
    protected const NAME = 'groq_get_fine_tuning';
    protected const DESCRIPTION = 'Retrieve a Groq fine-tuning job by ID.';
    protected const METHOD = 'getFineTuning';
    protected const ARGUMENTS = ['id'];
    protected const REQUIRED = ['id'];
}
