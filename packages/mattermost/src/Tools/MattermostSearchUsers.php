<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

/**
 * Search Mattermost users.
 *
 * Finds users by username, nickname, first name, last name, or email depending
 * on server settings and caller permissions.
 */
class MattermostSearchUsers extends AbstractMattermostTool
{
    protected const NAME = 'mattermost_search_users';
    protected const DESCRIPTION = 'Search Mattermost users. Pass term and optional filters.';
    protected const PARAMETERS = [
        'term' => ['type' => 'string', 'required' => true, 'description' => 'Search term.'],
        'team_id' => ['type' => 'string', 'description' => 'Restrict search to team ID.'],
        'not_in_team_id' => ['type' => 'string', 'description' => 'Exclude users in this team ID.'],
        'allow_inactive' => ['type' => 'boolean', 'description' => 'Include inactive users.'],
        'body' => ['type' => 'object', 'description' => 'Raw user search body.'],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/users/search';
    protected const REQUIRED = ['term'];
    protected const BODY_KEYS = ['term', 'team_id', 'not_in_team_id', 'allow_inactive'];
    protected const BODY_REQUIRED = true;
}
