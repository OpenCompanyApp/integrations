<?php

namespace OpenCompany\Integrations\LaunchDarkly\Tools;

/**
 * List LaunchDarkly teams.
 */
class LaunchDarklyListTeams extends AbstractLaunchDarklyTool
{
    protected const NAME = 'launchdarkly_list_teams';
    protected const DESCRIPTION = 'List LaunchDarkly teams with optional pagination, filters, and expansions. Teams may require an Enterprise plan.';
    protected const METHOD = 'GET';
    protected const PATH = '/teams';
    protected const QUERY_KEYS = ['limit', 'offset', 'filter', 'expand'];
    protected const PARAMETERS = [
        'limit' => ['type' => 'integer', 'description' => 'Maximum teams to return.'],
        'offset' => ['type' => 'integer', 'description' => 'Pagination offset.'],
        'filter' => ['type' => 'string', 'description' => 'Filter expression such as query:ops or nomembers:false.'],
        'expand' => ['type' => 'string', 'description' => 'Comma-separated expansions such as members,maintainers,roles,projects.'],
        'query' => ['type' => 'object', 'description' => 'Additional query parameters.'],
    ];
}
