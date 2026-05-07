<?php

namespace OpenCompany\Integrations\Clerk\Tools;

/**
 * Unban a Clerk user.
 *
 * Allows a previously banned user to sign in again.
 */
class ClerkUnbanUser extends AbstractClerkTool
{
    protected const NAME = 'clerk_unban_user';
    protected const DESCRIPTION = 'Unban a Clerk user.';
    protected const PARAMETERS = [
        'user_id' => ['type' => 'string', 'required' => true, 'description' => 'Clerk user ID.'],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/users/{user_id}/unban';
    protected const REQUIRED = ['user_id'];
}
