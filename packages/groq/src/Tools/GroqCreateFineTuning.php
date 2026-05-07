<?php

namespace OpenCompany\Integrations\Groq\Tools;

/**
 * Create a Groq fine-tuning job.
 */
class GroqCreateFineTuning extends AbstractGroqTool
{
    protected const NAME = 'groq_create_fine_tuning';
    protected const DESCRIPTION = 'Create a Groq fine-tuning job from an uploaded file.';
    protected const METHOD = 'createFineTuning';
    protected const REQUIRED = ['payload'];
    protected const USE_PAYLOAD = true;
}
