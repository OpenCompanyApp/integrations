<?php

namespace OpenCompany\Integrations\UptimeRobot\Tools;

/**
 * List incidents.
 *
 * Maps to the official UptimeRobot endpoint GET /incidents.
 */
class UptimeRobotIncidentsList extends AbstractUptimeRobotTool
{
    protected const NAME = 'uptimerobot_incidents_list';
    protected const DESCRIPTION = 'List incidents

Official UptimeRobot endpoint: GET /incidents.';
    protected const PARAMETERS = [
        'cursor' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Cursor to paginate through incidents (incident ID)',
        ],
        'monitor_id' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Filter incidents by monitor ID',
        ],
        'monitor_name' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Filter incidents by monitor name (partial match)',
        ],
        'started_after' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Filter incidents started after this date (ISO 8601 format)',
        ],
        'started_before' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Filter incidents started before this date (ISO 8601 format)',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/incidents';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'monitor_id' => 'monitor_id',
        'monitor_name' => 'monitor_name',
        'started_after' => 'started_after',
        'started_before' => 'started_before',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
