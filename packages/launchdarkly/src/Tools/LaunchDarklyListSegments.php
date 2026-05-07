<?php

namespace OpenCompany\Integrations\LaunchDarkly\Tools;

/**
 * List LaunchDarkly segments for an environment.
 */
class LaunchDarklyListSegments extends AbstractLaunchDarklyTool
{
    protected const NAME = 'launchdarkly_list_segments';
    protected const DESCRIPTION = 'List rule-based, list-based, and synced segments for a LaunchDarkly project environment.';
    protected const METHOD = 'GET';
    protected const PATH = '/segments/{project_key}/{environment_key}';
    protected const REQUIRED = ['project_key', 'environment_key'];
    protected const QUERY_KEYS = ['limit', 'offset', 'filter', 'sort'];
    protected const PARAMETERS = [
        'project_key' => ['type' => 'string', 'required' => true, 'description' => 'Project key.'],
        'environment_key' => ['type' => 'string', 'required' => true, 'description' => 'Environment key.'],
        'limit' => ['type' => 'integer', 'description' => 'Maximum segments to return.'],
        'offset' => ['type' => 'integer', 'description' => 'Pagination offset.'],
        'filter' => ['type' => 'string', 'description' => 'LaunchDarkly filter expression.'],
        'sort' => ['type' => 'string', 'description' => 'Sort field.'],
        'query' => ['type' => 'object', 'description' => 'Additional query parameters.'],
    ];
}
