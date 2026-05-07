<?php

namespace OpenCompany\Integrations\Clerk\Tools;

/**
 * List Clerk sessions.
 *
 * Supports user, client, and status filters.
 */
class ClerkListSessions extends AbstractClerkTool
{
    protected const NAME = 'clerk_list_sessions';
    protected const DESCRIPTION = 'List Clerk sessions. Provide user_id or client_id when filtering sessions.';
    protected const PARAMETERS = [
        'user_id' => ['type' => 'string', 'description' => 'User ID filter.'],
        'client_id' => ['type' => 'string', 'description' => 'Client ID filter.'],
        'status' => ['type' => 'string', 'description' => 'Session status filter.'],
        'limit' => ['type' => 'integer', 'description' => 'Maximum sessions to return.'],
        'offset' => ['type' => 'integer', 'description' => 'Pagination offset.'],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/sessions';
    protected const QUERY_KEYS = ['user_id', 'client_id', 'status', 'limit', 'offset'];
}
