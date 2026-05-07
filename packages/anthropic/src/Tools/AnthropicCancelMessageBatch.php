<?php

namespace OpenCompany\Integrations\Anthropic\Tools;

/**
 * Cancel an in-progress Anthropic Message Batch.
 */
class AnthropicCancelMessageBatch extends AbstractAnthropicTool
{
    protected const NAME = 'anthropic_cancel_message_batch';
    protected const DESCRIPTION = 'Cancel an in-progress Message Batch before processing ends.';
    protected const METHOD = 'cancelMessageBatch';
    protected const ARGUMENTS = ['id'];
    protected const REQUIRED = ['id'];
}
