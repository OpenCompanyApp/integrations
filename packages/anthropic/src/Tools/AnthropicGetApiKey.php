<?php

namespace OpenCompany\Integrations\Anthropic\Tools;

/**
 * Get one Anthropic organization API key metadata record.
 */
class AnthropicGetApiKey extends AbstractAnthropicTool
{
    protected const NAME = 'anthropic_get_api_key';
    protected const DESCRIPTION = 'Get metadata for one organization API key using the Anthropic Admin API.';
    protected const METHOD = 'getApiKey';
    protected const ARGUMENTS = ['id'];
    protected const REQUIRED = ['id'];
    protected const ADMIN = true;
}
