<?php

namespace OpenCompany\Integrations\Clerk\Tools;

/**
 * Unlock a Clerk user.
 *
 * Unlocks a user account through Clerk's Backend API.
 */
class ClerkUnlockUser extends AbstractClerkTool
{
    protected const NAME = 'clerk_unlock_user';
    protected const DESCRIPTION = 'Unlock a Clerk user.';
    protected const PARAMETERS = [
        'user_id' => ['type' => 'string', 'required' => true, 'description' => 'Clerk user ID.'],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/users/{user_id}/unlock';
    protected const REQUIRED = ['user_id'];
}
