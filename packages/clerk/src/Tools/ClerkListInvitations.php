<?php

namespace OpenCompany\Integrations\Clerk\Tools;

/**
 * List application invitations.
 *
 * Retrieves invitations for users to join the application.
 */
class ClerkListInvitations extends AbstractClerkTool
{
    protected const NAME = 'clerk_list_invitations';
    protected const DESCRIPTION = 'List Clerk application invitations.';
    protected const PARAMETERS = [
        'limit' => ['type' => 'integer', 'description' => 'Maximum invitations to return.'],
        'offset' => ['type' => 'integer', 'description' => 'Pagination offset.'],
        'status' => ['type' => 'string', 'description' => 'Invitation status filter.'],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/invitations';
    protected const QUERY_KEYS = ['limit', 'offset', 'status'];
}
