<?php

namespace OpenCompany\Integrations\LaunchDarkly\Tools;

/**
 * Get a LaunchDarkly team.
 */
class LaunchDarklyGetTeam extends AbstractLaunchDarklyTool
{
    protected const NAME = 'launchdarkly_get_team';
    protected const DESCRIPTION = 'Get a LaunchDarkly team by team key.';
    protected const METHOD = 'GET';
    protected const PATH = '/teams/{team_key}';
    protected const REQUIRED = ['team_key'];
    protected const QUERY_KEYS = ['expand'];
    protected const PARAMETERS = [
        'team_key' => ['type' => 'string', 'required' => true, 'description' => 'Team key.'],
        'expand' => ['type' => 'string', 'description' => 'Comma-separated expansions such as members,maintainers,roles,projects.'],
        'query' => ['type' => 'object', 'description' => 'Additional query parameters.'],
    ];
}
