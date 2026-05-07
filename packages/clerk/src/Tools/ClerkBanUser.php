<?php

namespace OpenCompany\Integrations\Clerk\Tools;

/**
 * Ban a Clerk user.
 *
 * Prevents a user from signing in.
 */
class ClerkBanUser extends AbstractClerkTool
{
    protected const NAME = 'clerk_ban_user';
    protected const DESCRIPTION = 'Ban a Clerk user.';
    protected const PARAMETERS = [
        'user_id' => ['type' => 'string', 'required' => true, 'description' => 'Clerk user ID.'],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/users/{user_id}/ban';
    protected const REQUIRED = ['user_id'];
}
