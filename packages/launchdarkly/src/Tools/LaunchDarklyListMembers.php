<?php

namespace OpenCompany\Integrations\LaunchDarkly\Tools;

/**
 * List LaunchDarkly account members.
 */
class LaunchDarklyListMembers extends AbstractLaunchDarklyTool
{
    protected const NAME = 'launchdarkly_list_members';
    protected const DESCRIPTION = 'List LaunchDarkly account members with optional pagination and filters.';
    protected const METHOD = 'GET';
    protected const PATH = '/members';
    protected const QUERY_KEYS = ['limit', 'offset', 'filter', 'sort', 'role'];
    protected const PARAMETERS = [
        'limit' => ['type' => 'integer', 'description' => 'Maximum members to return.'],
        'offset' => ['type' => 'integer', 'description' => 'Pagination offset.'],
        'filter' => ['type' => 'string', 'description' => 'LaunchDarkly filter expression.'],
        'sort' => ['type' => 'string', 'description' => 'Sort field.'],
        'role' => ['type' => 'string', 'description' => 'Role filter when supported by the account API version.'],
        'query' => ['type' => 'object', 'description' => 'Additional query parameters.'],
    ];
}
