<?php

namespace OpenCompany\Integrations\UptimeRobot\Tools;

/**
 * List monitors.
 *
 * Maps to the official UptimeRobot endpoint GET /monitors.
 */
class UptimeRobotMonitorsList extends AbstractUptimeRobotTool
{
    protected const NAME = 'uptimerobot_monitors_list';
    protected const DESCRIPTION = 'List monitors

Official UptimeRobot endpoint: GET /monitors.';
    protected const PARAMETERS = [
        'custom_field' => [
            'type' => 'array',
            'required' => false,
            'description' => 'Filter monitors by custom field key:value pairs. Format: customField=key:value. Multiple filters use AND logic. Split on first colon only.',
            'items' => [
                'type' => 'string',
            ],
        ],
        'limit' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Maximum number of monitors to return per page. Default: 50, Min: 1, Max: 200.',
        ],
        'group_id' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Filter monitors by monitor group ID.',
        ],
        'status' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Comma-separated list of status values to filter monitors. Uses OR logic (matches any specified status). Case-insensitive. Allowed values: PAUSED, STARTED, UP, LOOKS_DOWN, DOWN.',
        ],
        'name' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Filter monitors by name. Case-insensitive partial match on the monitor friendly name.',
        ],
        'url' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Filter monitors by URL. Case-insensitive partial match on the monitor URL.',
        ],
        'tags' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Comma-separated list of tag names to filter monitors. Uses OR logic (matches any specified tag). Case-sensitive.',
        ],
        'cursor' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Cursor to paginate through monitors',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/monitors';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'customField' => 'custom_field',
        'limit' => 'limit',
        'groupId' => 'group_id',
        'status' => 'status',
        'name' => 'name',
        'url' => 'url',
        'tags' => 'tags',
        'cursor' => 'cursor',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
