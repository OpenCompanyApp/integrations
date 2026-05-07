<?php

namespace OpenCompany\Integrations\Anthropic\Tools;

/**
 * List Anthropic Message Batches for the API key workspace.
 */
class AnthropicListMessageBatches extends AbstractAnthropicTool
{
    protected const NAME = 'anthropic_list_message_batches';
    protected const DESCRIPTION = 'List Message Batches in the workspace for this API key.';
    protected const METHOD = 'listMessageBatches';
    protected const USE_QUERY = true;
}
