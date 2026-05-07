<?php

namespace OpenCompany\Integrations\Anthropic\Tools;

/**
 * List organization users through the Anthropic Admin API.
 */
class AnthropicListUsers extends AbstractAnthropicTool
{
    protected const NAME = 'anthropic_list_users';
    protected const DESCRIPTION = 'List organization users with pagination using the Anthropic Admin API.';
    protected const METHOD = 'listUsers';
    protected const USE_QUERY = true;
    protected const ADMIN = true;
}
