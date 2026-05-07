<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

/**
 * List Mattermost users.
 *
 * Retrieves users with standard pagination.
 */
class MattermostListUsers extends AbstractMattermostTool
{
    protected const NAME = 'mattermost_list_users';
    protected const DESCRIPTION = 'List Mattermost users with pagination.';
    protected const PARAMETERS = [
        'page' => ['type' => 'integer', 'description' => 'Page number, 0-indexed.'],
        'per_page' => ['type' => 'integer', 'description' => 'Users per page.'],
        'in_team' => ['type' => 'string', 'description' => 'Filter to users in team ID.'],
        'not_in_team' => ['type' => 'string', 'description' => 'Filter to users not in team ID.'],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/users';
    protected const QUERY_KEYS = ['page', 'per_page', 'in_team', 'not_in_team'];
}
