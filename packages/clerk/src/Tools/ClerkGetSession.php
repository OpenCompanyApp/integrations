<?php

namespace OpenCompany\Integrations\Clerk\Tools;

/**
 * Get a Clerk session.
 *
 * Retrieves one Backend Session object by session ID.
 */
class ClerkGetSession extends AbstractClerkTool
{
    protected const NAME = 'clerk_get_session';
    protected const DESCRIPTION = 'Get a Clerk session by session_id.';
    protected const PARAMETERS = [
        'session_id' => ['type' => 'string', 'required' => true, 'description' => 'Clerk session ID.'],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/sessions/{session_id}';
    protected const REQUIRED = ['session_id'];
}
