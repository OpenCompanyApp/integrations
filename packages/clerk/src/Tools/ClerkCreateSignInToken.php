<?php

namespace OpenCompany\Integrations\Clerk\Tools;

/**
 * Create a Clerk sign-in token.
 *
 * Creates a short-lived token that can sign in a specific user.
 */
class ClerkCreateSignInToken extends AbstractClerkTool
{
    protected const NAME = 'clerk_create_sign_in_token';
    protected const DESCRIPTION = 'Create a Clerk sign-in token for a user.';
    protected const PARAMETERS = [
        'user_id' => ['type' => 'string', 'required' => true, 'description' => 'User ID.'],
        'expires_in_seconds' => ['type' => 'integer', 'description' => 'Token lifetime in seconds.'],
        'body' => ['type' => 'object', 'description' => 'Raw sign-in token body.'],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/sign_in_tokens';
    protected const REQUIRED = ['user_id'];
    protected const BODY_KEYS = ['user_id', 'expires_in_seconds'];
    protected const BODY_REQUIRED = true;
}
