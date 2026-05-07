<?php

namespace OpenCompany\Integrations\Mattermost\Tools;

/**
 * Search posts in a team.
 *
 * Searches posts using Mattermost's team post search endpoint.
 */
class MattermostSearchPosts extends AbstractMattermostTool
{
    protected const NAME = 'mattermost_search_posts';
    protected const DESCRIPTION = 'Search posts in a Mattermost team.';
    protected const PARAMETERS = [
        'team_id' => ['type' => 'string', 'required' => true, 'description' => 'Team ID.'],
        'terms' => ['type' => 'string', 'required' => true, 'description' => 'Search terms.'],
        'is_or_search' => ['type' => 'boolean', 'description' => 'Whether to use OR search.'],
        'body' => ['type' => 'object', 'description' => 'Raw post search body.'],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/teams/{team_id}/posts/search';
    protected const REQUIRED = ['team_id', 'terms'];
    protected const BODY_KEYS = ['terms', 'is_or_search'];
    protected const BODY_REQUIRED = true;
}
