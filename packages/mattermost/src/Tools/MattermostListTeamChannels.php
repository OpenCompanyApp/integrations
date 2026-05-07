<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

/**
 * List channels in a team.
 *
 * Retrieves public and private channels visible to the caller in one team.
 */
class MattermostListTeamChannels extends AbstractMattermostTool
{
    protected const NAME = 'mattermost_list_team_channels';
    protected const DESCRIPTION = 'List channels in a Mattermost team.';
    protected const PARAMETERS = [
        'team_id' => ['type' => 'string', 'required' => true, 'description' => 'Team ID.'],
        'page' => ['type' => 'integer', 'description' => 'Page number.'],
        'per_page' => ['type' => 'integer', 'description' => 'Channels per page.'],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/teams/{team_id}/channels';
    protected const REQUIRED = ['team_id'];
    protected const QUERY_KEYS = ['page', 'per_page'];
}
