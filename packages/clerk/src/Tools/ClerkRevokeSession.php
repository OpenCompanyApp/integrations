<?php

namespace OpenCompany\Integrations\Clerk\Tools;

/**
 * Revoke a Clerk session.
 *
 * Ends a session through the Clerk Backend API.
 */
class ClerkRevokeSession extends AbstractClerkTool
{
    protected const NAME = 'clerk_revoke_session';
    protected const DESCRIPTION = 'Revoke a Clerk session.';
    protected const PARAMETERS = [
        'session_id' => ['type' => 'string', 'required' => true, 'description' => 'Clerk session ID.'],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/sessions/{session_id}/revoke';
    protected const REQUIRED = ['session_id'];
}
