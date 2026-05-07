<?php

namespace OpenCompany\Integrations\Anthropic\Tools;

/**
 * Update an Anthropic organization user's role.
 */
class AnthropicUpdateUser extends AbstractAnthropicTool
{
    protected const NAME = 'anthropic_update_user';
    protected const DESCRIPTION = 'Update an organization user role using the Anthropic Admin API.';
    protected const METHOD = 'updateUser';
    protected const ARGUMENTS = ['id'];
    protected const REQUIRED = ['id', 'payload'];
    protected const USE_PAYLOAD = true;
    protected const ADMIN = true;
}
