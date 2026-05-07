<?php

namespace OpenCompany\Integrations\Groq\Tools;

/**
 * Cancel a Groq batch job.
 */
class GroqCancelBatch extends AbstractGroqTool
{
    protected const NAME = 'groq_cancel_batch';
    protected const DESCRIPTION = 'Cancel a Groq batch job by ID.';
    protected const METHOD = 'cancelBatch';
    protected const ARGUMENTS = ['batch_id'];
    protected const REQUIRED = ['batch_id'];
}
