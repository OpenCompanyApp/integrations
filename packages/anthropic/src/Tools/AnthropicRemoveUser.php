<?php

namespace OpenCompany\Integrations\Anthropic\Tools;

/**
 * Remove a user from an Anthropic organization.
 */
class AnthropicRemoveUser extends AbstractAnthropicTool
{
    protected const NAME = 'anthropic_remove_user';
    protected const DESCRIPTION = 'Remove an organization user using the Anthropic Admin API.';
    protected const METHOD = 'removeUser';
    protected const ARGUMENTS = ['id'];
    protected const REQUIRED = ['id'];
    protected const ADMIN = true;
}
