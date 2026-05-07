<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

/**
 * Search team channels.
 *
 * Searches channels in a Mattermost team by term.
 */
class MattermostSearchChannels extends AbstractMattermostTool
{
    protected const NAME = 'mattermost_search_channels';
    protected const DESCRIPTION = 'Search channels in a Mattermost team.';
    protected const PARAMETERS = [
        'team_id' => ['type' => 'string', 'required' => true, 'description' => 'Team ID.'],
        'term' => ['type' => 'string', 'required' => true, 'description' => 'Search term.'],
        'body' => ['type' => 'object', 'description' => 'Raw channel search body.'],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/teams/{team_id}/channels/search';
    protected const REQUIRED = ['team_id', 'term'];
    protected const BODY_KEYS = ['term'];
    protected const BODY_REQUIRED = true;
}
