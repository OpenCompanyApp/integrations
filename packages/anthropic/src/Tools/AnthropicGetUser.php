<?php

namespace OpenCompany\Integrations\Anthropic\Tools;

/**
 * Get one Anthropic organization user.
 */
class AnthropicGetUser extends AbstractAnthropicTool
{
    protected const NAME = 'anthropic_get_user';
    protected const DESCRIPTION = 'Get one organization user by ID using the Anthropic Admin API.';
    protected const METHOD = 'getUser';
    protected const ARGUMENTS = ['id'];
    protected const REQUIRED = ['id'];
    protected const ADMIN = true;
}
