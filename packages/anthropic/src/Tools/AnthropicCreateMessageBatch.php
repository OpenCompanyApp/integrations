<?php

namespace OpenCompany\Integrations\Anthropic\Tools;

/**
 * Create an asynchronous Anthropic Message Batch.
 */
class AnthropicCreateMessageBatch extends AbstractAnthropicTool
{
    protected const NAME = 'anthropic_create_message_batch';
    protected const DESCRIPTION = 'Create a Message Batch with up to many independent Messages API requests.';
    protected const METHOD = 'createMessageBatch';
    protected const REQUIRED = ['payload'];
    protected const USE_PAYLOAD = true;
}
