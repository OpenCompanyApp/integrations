<?php

namespace OpenCompany\Integrations\Clerk\Tools;

/**
 * Lock a Clerk user.
 *
 * Locks a user account through Clerk's Backend API.
 */
class ClerkLockUser extends AbstractClerkTool
{
    protected const NAME = 'clerk_lock_user';
    protected const DESCRIPTION = 'Lock a Clerk user.';
    protected const PARAMETERS = [
        'user_id' => ['type' => 'string', 'required' => true, 'description' => 'Clerk user ID.'],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/users/{user_id}/lock';
    protected const REQUIRED = ['user_id'];
}
