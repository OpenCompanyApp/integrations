<?php

namespace OpenCompany\Integrations\Anthropic\Tools;

/**
 * Retrieve one Anthropic Message Batch.
 */
class AnthropicGetMessageBatch extends AbstractAnthropicTool
{
    protected const NAME = 'anthropic_get_message_batch';
    protected const DESCRIPTION = 'Retrieve one Message Batch by ID and inspect its processing status.';
    protected const METHOD = 'getMessageBatch';
    protected const ARGUMENTS = ['id'];
    protected const REQUIRED = ['id'];
}
