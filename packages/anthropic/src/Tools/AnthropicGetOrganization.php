<?php

namespace OpenCompany\Integrations\Anthropic\Tools;

/**
 * Get organization information from the Anthropic Admin API.
 */
class AnthropicGetOrganization extends AbstractAnthropicTool
{
    protected const NAME = 'anthropic_get_organization';
    protected const DESCRIPTION = 'Get organization information for the configured Anthropic Admin API key.';
    protected const METHOD = 'getOrganization';
    protected const ADMIN = true;
}
