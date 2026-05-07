<?php

namespace OpenCompany\Integrations\UptimeRobot\Tools;

/**
 * Delete a monitor group.
 *
 * Maps to the official UptimeRobot endpoint DELETE /monitor-groups/{id}.
 */
class UptimeRobotMonitorGroupsDelete extends AbstractUptimeRobotTool
{
    protected const NAME = 'uptimerobot_monitor_groups_delete';
    protected const DESCRIPTION = 'Delete a monitor group

Official UptimeRobot endpoint: DELETE /monitor-groups/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The monitor group ID to delete',
        ],
        'monitors_new_group_id' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Optional group ID to move monitors to. If not provided, monitors will be moved to default group (ID: 0).',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/monitor-groups/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [
        'monitorsNewGroupId' => 'monitors_new_group_id',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
