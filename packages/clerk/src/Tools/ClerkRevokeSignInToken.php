<?php

namespace OpenCompany\Integrations\Clerk\Tools;

/**
 * Revoke a Clerk sign-in token.
 *
 * Invalidates a sign-in token by token ID.
 */
class ClerkRevokeSignInToken extends AbstractClerkTool
{
    protected const NAME = 'clerk_revoke_sign_in_token';
    protected const DESCRIPTION = 'Revoke a Clerk sign-in token.';
    protected const PARAMETERS = [
        'sign_in_token_id' => ['type' => 'string', 'required' => true, 'description' => 'Sign-in token ID.'],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/sign_in_tokens/{sign_in_token_id}/revoke';
    protected const REQUIRED = ['sign_in_token_id'];
}
