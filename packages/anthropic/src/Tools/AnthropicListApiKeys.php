<?php

namespace OpenCompany\Integrations\Anthropic\Tools;

/**
 * List Anthropic organization API keys.
 */
class AnthropicListApiKeys extends AbstractAnthropicTool
{
    protected const NAME = 'anthropic_list_api_keys';
    protected const DESCRIPTION = 'List organization API keys using the Anthropic Admin API.';
    protected const METHOD = 'listApiKeys';
    protected const USE_QUERY = true;
    protected const ADMIN = true;
}
