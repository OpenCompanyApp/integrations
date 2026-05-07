<?php

namespace OpenCompany\Integrations\Groq\Tools;

/**
 * Retrieve a Groq batch job.
 */
class GroqGetBatch extends AbstractGroqTool
{
    protected const NAME = 'groq_get_batch';
    protected const DESCRIPTION = 'Retrieve a Groq batch by ID.';
    protected const METHOD = 'getBatch';
    protected const ARGUMENTS = ['batch_id'];
    protected const REQUIRED = ['batch_id'];
}
