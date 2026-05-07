<?php

namespace OpenCompany\Integrations\Anthropic\Tools;

/**
 * Delete a completed Anthropic Message Batch.
 */
class AnthropicDeleteMessageBatch extends AbstractAnthropicTool
{
    protected const NAME = 'anthropic_delete_message_batch';
    protected const DESCRIPTION = 'Delete a completed Message Batch after its results are no longer needed.';
    protected const METHOD = 'deleteMessageBatch';
    protected const ARGUMENTS = ['id'];
    protected const REQUIRED = ['id'];
}
