<?php

namespace OpenCompany\Integrations\Groq\Tools;

/**
 * List Groq batch jobs.
 */
class GroqListBatches extends AbstractGroqTool
{
    protected const NAME = 'groq_list_batches';
    protected const DESCRIPTION = 'List Groq batch jobs with cursor pagination.';
    protected const METHOD = 'listBatches';
    protected const USE_QUERY = true;
}
