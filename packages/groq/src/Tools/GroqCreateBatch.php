<?php

namespace OpenCompany\Integrations\Groq\Tools;

/**
 * Create a Groq batch job.
 */
class GroqCreateBatch extends AbstractGroqTool
{
    protected const NAME = 'groq_create_batch';
    protected const DESCRIPTION = 'Create a Groq batch job from an uploaded JSONL file.';
    protected const METHOD = 'createBatch';
    protected const REQUIRED = ['payload'];
    protected const USE_PAYLOAD = true;
}
