<?php

namespace OpenCompany\Integrations\Clerk\Tools;

/**
 * Count Clerk users.
 *
 * Returns the number of users matching optional filters.
 */
class ClerkCountUsers extends AbstractClerkTool
{
    protected const NAME = 'clerk_count_users';
    protected const DESCRIPTION = 'Count users in Clerk with optional query filters.';
    protected const PARAMETERS = [
        'email_address' => ['type' => 'string', 'description' => 'Filter by email address.'],
        'phone_number' => ['type' => 'string', 'description' => 'Filter by phone number.'],
        'query' => ['type' => 'string', 'description' => 'Search query.'],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/users/count';
    protected const QUERY_KEYS = ['email_address', 'phone_number', 'query'];
}
