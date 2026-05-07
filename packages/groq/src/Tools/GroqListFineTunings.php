<?php

namespace OpenCompany\Integrations\Groq\Tools;

/**
 * List Groq fine-tuning jobs.
 */
class GroqListFineTunings extends AbstractGroqTool
{
    protected const NAME = 'groq_list_fine_tunings';
    protected const DESCRIPTION = 'List Groq fine-tuning jobs from the closed beta API.';
    protected const METHOD = 'listFineTunings';
}
