<?php

namespace OpenCompany\Integrations\Anthropic\Tools;

/**
 * Retrieve JSONL results for a completed Anthropic Message Batch.
 */
class AnthropicGetMessageBatchResults extends AbstractAnthropicTool
{
    protected const NAME = 'anthropic_get_message_batch_results';
    protected const DESCRIPTION = 'Retrieve JSONL results for a completed Message Batch.';
    protected const METHOD = 'getMessageBatchResults';
    protected const ARGUMENTS = ['id'];
    protected const REQUIRED = ['id'];
}
