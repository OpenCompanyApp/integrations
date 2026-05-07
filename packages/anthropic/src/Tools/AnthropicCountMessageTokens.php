<?php

namespace OpenCompany\Integrations\Anthropic\Tools;

/**
 * Count input tokens for a Messages API request without creating a message.
 */
class AnthropicCountMessageTokens extends AbstractAnthropicTool
{
    protected const NAME = 'anthropic_count_message_tokens';
    protected const DESCRIPTION = 'Count input tokens for a Messages API payload without generating a response.';
    protected const METHOD = 'countMessageTokens';
    protected const REQUIRED = ['payload'];
    protected const USE_PAYLOAD = true;
}
