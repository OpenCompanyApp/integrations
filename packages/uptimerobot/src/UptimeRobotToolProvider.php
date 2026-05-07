<?php

namespace OpenCompany\Integrations\UptimeRobot;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotBulkMonitorsBulkPause;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotBulkMonitorsBulkStart;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotBulkMonitorsBulkUpdate;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotIncidentsList;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotIncidentsGet;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotIncidentsListComments;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotIncidentsCreateComment;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotIncidentsGetActivityLog;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotIncidentsGetAlerts;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotIncidentsUpdateComment;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotIncidentsDeleteComment;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotMonitorGroupsCreate;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotMonitorGroupsList;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotMonitorGroupsGet;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotMonitorGroupsUpdate;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotMonitorGroupsDelete;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotMonitorsList;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotMonitorsCreate;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotMonitorsGetUptimeStats;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotMonitorsGetMonitorUptimeStats;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotMonitorsGetMonitorResponseTimeStatsByRegion;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotMonitorsGetMonitorResponseTimeStats;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotMonitorsGet;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotMonitorsUpdate;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotMonitorsDelete;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotMonitorsReset;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotMonitorsPause;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotMonitorsStart;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotPspList;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotPspCreate;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotPspGet;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotPspUpdate;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotPspDelete;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotPspAnnouncementsList;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotPspAnnouncementsCreate;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotPspAnnouncementsGet;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotPspAnnouncementsUpdate;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotPspAnnouncementsPin;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotPspAnnouncementsUnpin;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotMaintenanceWindowsList;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotMaintenanceWindowsCreate;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotMaintenanceWindowsGet;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotMaintenanceWindowsUpdate;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotMaintenanceWindowsDelete;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotUserGetMe;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotUserGetAlertContacts;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotUserGetAllAlertContacts;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotIntegrationsList;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotIntegrationsCreate;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotIntegrationsGet;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotIntegrationsUpdate;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotIntegrationsDelete;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotTagsGetTags;
use OpenCompany\Integrations\UptimeRobot\Tools\UptimeRobotTagsDeleteTag;

/**
 * Tool catalog and configuration metadata for UptimeRobot.
 *
 * Exposes the official UptimeRobot v3 OpenAPI operation set as endpoint-specific
 * tools and resolves account-specific API tokens for multi-account hosts.
 */
class UptimeRobotToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /** @return array<string, mixed> */
    public function integrationCapabilities(): array
    {
        return ['auth' => ['strategy' => 'bearer_token', 'legacy_auth_type' => 'api_key', 'credential_mode' => 'secret', 'setup_flows' => ['manual_secret'], 'requires_browser_for_setup' => false, 'refreshable' => false, 'token_keys' => [], 'notes' => ['UptimeRobot v3 uses Authorization: Bearer <api_key>.']], 'host_availability' => ['web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'], 'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal']], 'runtime_requirements' => [], 'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true]];
    }

    public function appName(): string { return 'uptimerobot'; }
    public function appMeta(): array { return ['label' => 'UptimeRobot', 'description' => 'Uptime monitors, incidents, monitor groups, public status pages, maintenance windows, integrations, and tags', 'icon' => 'ph:heartbeat', 'logo' => 'ph:heartbeat']; }
    public function integrationMeta(): array { return ['name' => 'UptimeRobot', 'description' => 'Manage UptimeRobot v3 monitors, incidents, monitor groups, public status pages, announcements, maintenance windows, integrations, tags, and user alert contacts.', 'icon' => 'ph:heartbeat', 'logo' => 'ph:heartbeat', 'category' => 'analytics', 'badge' => 'verified', 'docs_url' => 'https://uptimerobot.com/api/v3/']; }
    public function configSchema(): array { return [['key' => 'api_key', 'type' => 'secret', 'label' => 'API Token', 'placeholder' => 'UptimeRobot API token', 'hint' => 'Sent as Authorization: Bearer <token>.', 'required' => true], ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://api.uptimerobot.com/v3', 'hint' => 'Use https://api.uptimerobot.com/v3 for the current API.', 'default' => 'https://api.uptimerobot.com/v3']]; }

    /** @param  array<string, mixed>  $config  Credential and endpoint settings. @return array{success: bool, message?: string, error?: string} */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.uptimerobot.com/v3'), '/');
        if ($apiKey === '') { return ['success' => false, 'error' => 'UptimeRobot API token is required.']; }

        try {
            $response = Http::withHeaders(['Authorization' => 'Bearer ' . $apiKey, 'Accept' => 'application/json'])->timeout(10)->get($baseUrl . '/user/me');
            if (!$response->successful()) { return ['success' => false, 'error' => 'UptimeRobot API returned HTTP ' . $response->status() . '.']; }
            return ['success' => true, 'message' => 'Connected to UptimeRobot at ' . $baseUrl . '.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array { return ['api_key' => 'nullable|string', 'url' => 'nullable|url']; }
    public function credentialFields(): array { return $this->configSchema(); }
    public function tools(): array { return [
            'uptimerobot_bulk_monitors_bulk_pause' => [
                'class' => UptimeRobotBulkMonitorsBulkPause::class,
                'name' => 'Bulk Monitors Bulk Pause',
                'description' => 'Pause all monitors in a group

Official UptimeRobot endpoint: POST /monitors/bulk/pause.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official UptimeRobot OpenAPI schema.',
                    ],
                ],
            ],
            'uptimerobot_bulk_monitors_bulk_start' => [
                'class' => UptimeRobotBulkMonitorsBulkStart::class,
                'name' => 'Bulk Monitors Bulk Start',
                'description' => 'Start all monitors in a group

Official UptimeRobot endpoint: POST /monitors/bulk/start.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official UptimeRobot OpenAPI schema.',
                    ],
                ],
            ],
            'uptimerobot_bulk_monitors_bulk_update' => [
                'class' => UptimeRobotBulkMonitorsBulkUpdate::class,
                'name' => 'Bulk Monitors Bulk Update',
                'description' => 'Update all monitors in a group

Official UptimeRobot endpoint: POST /monitors/bulk/update.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official UptimeRobot OpenAPI schema.',
                    ],
                ],
            ],
            'uptimerobot_incidents_list' => [
                'class' => UptimeRobotIncidentsList::class,
                'name' => 'Incidents List',
                'description' => 'List incidents

Official UptimeRobot endpoint: GET /incidents.',
                'parameters' => [
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
                ],
            ],
            'uptimerobot_incidents_get' => [
                'class' => UptimeRobotIncidentsGet::class,
                'name' => 'Incidents Get',
                'description' => 'Get an incident by ID

Official UptimeRobot endpoint: GET /incidents/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The incident ID',
                    ],
                ],
            ],
            'uptimerobot_incidents_list_comments' => [
                'class' => UptimeRobotIncidentsListComments::class,
                'name' => 'Incidents List Comments',
                'description' => 'List incident comments

Official UptimeRobot endpoint: GET /incidents/{id}/comments.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The incident ID',
                    ],
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Cursor to paginate through comments (comment ID)',
                    ],
                    'limit' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Number of comments to return (1-100, default 50)',
                    ],
                ],
            ],
            'uptimerobot_incidents_create_comment' => [
                'class' => UptimeRobotIncidentsCreateComment::class,
                'name' => 'Incidents Create Comment',
                'description' => 'Create incident comment

Official UptimeRobot endpoint: POST /incidents/{id}/comments.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'ID of the incident',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official UptimeRobot OpenAPI schema.',
                    ],
                ],
            ],
            'uptimerobot_incidents_get_activity_log' => [
                'class' => UptimeRobotIncidentsGetActivityLog::class,
                'name' => 'Incidents Get Activity Log',
                'description' => 'Get incident activity log

Official UptimeRobot endpoint: GET /incidents/{id}/activity-log.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'ID of the incident',
                    ],
                ],
            ],
            'uptimerobot_incidents_get_alerts' => [
                'class' => UptimeRobotIncidentsGetAlerts::class,
                'name' => 'Incidents Get Alerts',
                'description' => 'Get incident sent alerts

Official UptimeRobot endpoint: GET /incidents/{id}/alerts.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'ID of the incident',
                    ],
                ],
            ],
            'uptimerobot_incidents_update_comment' => [
                'class' => UptimeRobotIncidentsUpdateComment::class,
                'name' => 'Incidents Update Comment',
                'description' => 'Update an incident comment

Official UptimeRobot endpoint: PATCH /incidents/{id}/comments/{commentId}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The incident ID',
                    ],
                    'comment_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The comment ID',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official UptimeRobot OpenAPI schema.',
                    ],
                ],
            ],
            'uptimerobot_incidents_delete_comment' => [
                'class' => UptimeRobotIncidentsDeleteComment::class,
                'name' => 'Incidents Delete Comment',
                'description' => 'Delete incident comment

Official UptimeRobot endpoint: DELETE /incidents/{id}/comments/{commentId}.',
                'parameters' => [
                    'id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'ID of the incident',
                    ],
                    'comment_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'ID of the comment',
                    ],
                ],
            ],
            'uptimerobot_monitor_groups_create' => [
                'class' => UptimeRobotMonitorGroupsCreate::class,
                'name' => 'Monitor Groups Create',
                'description' => 'Create a monitor group

Official UptimeRobot endpoint: POST /monitor-groups.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official UptimeRobot OpenAPI schema.',
                    ],
                ],
            ],
            'uptimerobot_monitor_groups_list' => [
                'class' => UptimeRobotMonitorGroupsList::class,
                'name' => 'Monitor Groups List',
                'description' => 'List monitor groups

Official UptimeRobot endpoint: GET /monitor-groups.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Cursor for pagination (ID of the last item from previous page)',
                    ],
                ],
            ],
            'uptimerobot_monitor_groups_get' => [
                'class' => UptimeRobotMonitorGroupsGet::class,
                'name' => 'Monitor Groups Get',
                'description' => 'Get a monitor group by ID

Official UptimeRobot endpoint: GET /monitor-groups/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The monitor group ID',
                    ],
                ],
            ],
            'uptimerobot_monitor_groups_update' => [
                'class' => UptimeRobotMonitorGroupsUpdate::class,
                'name' => 'Monitor Groups Update',
                'description' => 'Update a monitor group

Official UptimeRobot endpoint: PATCH /monitor-groups/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The monitor group ID',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official UptimeRobot OpenAPI schema.',
                    ],
                ],
            ],
            'uptimerobot_monitor_groups_delete' => [
                'class' => UptimeRobotMonitorGroupsDelete::class,
                'name' => 'Monitor Groups Delete',
                'description' => 'Delete a monitor group

Official UptimeRobot endpoint: DELETE /monitor-groups/{id}.',
                'parameters' => [
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
                ],
            ],
            'uptimerobot_monitors_list' => [
                'class' => UptimeRobotMonitorsList::class,
                'name' => 'Monitors List',
                'description' => 'List monitors

Official UptimeRobot endpoint: GET /monitors.',
                'parameters' => [
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
                ],
            ],
            'uptimerobot_monitors_create' => [
                'class' => UptimeRobotMonitorsCreate::class,
                'name' => 'Monitors Create',
                'description' => 'Create a monitor

Official UptimeRobot endpoint: POST /monitors.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official UptimeRobot OpenAPI schema.',
                    ],
                ],
            ],
            'uptimerobot_monitors_get_uptime_stats' => [
                'class' => UptimeRobotMonitorsGetUptimeStats::class,
                'name' => 'Monitors Get Uptime Stats',
                'description' => 'Get aggregated uptime statistics

Official UptimeRobot endpoint: GET /monitors/uptime-stats.',
                'parameters' => [
                    'log_limit' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Maximum number of log entries to return (1-500).',
                    ],
                    'time_frame' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Timeframe for statistics. Use CUSTOM with start/end for custom range.',
                        'enum' => ['DAY', 'WEEK', 'MONTH', 'DAYS_30', 'YEAR', 'ALL', 'CUSTOM'],
                    ],
                    'start' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Start timestamp (Unix seconds). Required when timeFrame=CUSTOM.',
                    ],
                    'end' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'End timestamp (Unix seconds). Required when timeFrame=CUSTOM. Must be > start.',
                    ],
                ],
            ],
            'uptimerobot_monitors_get_monitor_uptime_stats' => [
                'class' => UptimeRobotMonitorsGetMonitorUptimeStats::class,
                'name' => 'Monitors Get Monitor Uptime Stats',
                'description' => 'Get monitor uptime statistics

Official UptimeRobot endpoint: GET /monitors/{id}/stats/uptime.',
                'parameters' => [
                    'id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The monitor ID',
                    ],
                    'from' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Start date for statistics (ISO 8601 format). Defaults to 24 hours ago.',
                    ],
                    'to' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'End date for statistics (ISO 8601 format). Defaults to now.',
                    ],
                ],
            ],
            'uptimerobot_monitors_get_monitor_response_time_stats_by_region' => [
                'class' => UptimeRobotMonitorsGetMonitorResponseTimeStatsByRegion::class,
                'name' => 'Monitors Get Monitor Response Time Stats By Region',
                'description' => 'Get monitor response time statistics by region

Official UptimeRobot endpoint: GET /monitors/{id}/stats/response-time/all.',
                'parameters' => [
                    'id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The monitor ID',
                    ],
                    'from' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Start date for statistics (ISO 8601 format). Defaults to 24 hours ago.',
                    ],
                    'to' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'End date for statistics (ISO 8601 format). Defaults to now.',
                    ],
                    'include_time_series' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Whether to include time series data points in the response. Defaults to false.',
                    ],
                ],
            ],
            'uptimerobot_monitors_get_monitor_response_time_stats' => [
                'class' => UptimeRobotMonitorsGetMonitorResponseTimeStats::class,
                'name' => 'Monitors Get Monitor Response Time Stats',
                'description' => 'Get monitor response time statistics

Official UptimeRobot endpoint: GET /monitors/{id}/stats/response-time.',
                'parameters' => [
                    'id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'The monitor ID',
                    ],
                    'from' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Start date for statistics (ISO 8601 format). Defaults to 24 hours ago.',
                    ],
                    'to' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'End date for statistics (ISO 8601 format). Defaults to now.',
                    ],
                    'include_time_series' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Whether to include time series data points in the response. Defaults to false.',
                    ],
                    'region' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Filter by region code (na, eu, as, oc). When provided, only returns data for the specified region.',
                        'enum' => ['na', 'eu', 'as', 'oc', 'all'],
                    ],
                ],
            ],
            'uptimerobot_monitors_get' => [
                'class' => UptimeRobotMonitorsGet::class,
                'name' => 'Monitors Get',
                'description' => 'Get a monitor by ID

Official UptimeRobot endpoint: GET /monitors/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'id',
                    ],
                ],
            ],
            'uptimerobot_monitors_update' => [
                'class' => UptimeRobotMonitorsUpdate::class,
                'name' => 'Monitors Update',
                'description' => 'Update a monitor

Official UptimeRobot endpoint: PATCH /monitors/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official UptimeRobot OpenAPI schema.',
                    ],
                ],
            ],
            'uptimerobot_monitors_delete' => [
                'class' => UptimeRobotMonitorsDelete::class,
                'name' => 'Monitors Delete',
                'description' => 'Delete a monitor

Official UptimeRobot endpoint: DELETE /monitors/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'id',
                    ],
                ],
            ],
            'uptimerobot_monitors_reset' => [
                'class' => UptimeRobotMonitorsReset::class,
                'name' => 'Monitors Reset',
                'description' => 'Reset stats for a monitor

Official UptimeRobot endpoint: POST /monitors/{id}/reset.',
                'parameters' => [
                    'id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official UptimeRobot OpenAPI schema.',
                    ],
                ],
            ],
            'uptimerobot_monitors_pause' => [
                'class' => UptimeRobotMonitorsPause::class,
                'name' => 'Monitors Pause',
                'description' => 'Pause a monitor

Official UptimeRobot endpoint: POST /monitors/{id}/pause.',
                'parameters' => [
                    'id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official UptimeRobot OpenAPI schema.',
                    ],
                ],
            ],
            'uptimerobot_monitors_start' => [
                'class' => UptimeRobotMonitorsStart::class,
                'name' => 'Monitors Start',
                'description' => 'Start a monitor

Official UptimeRobot endpoint: POST /monitors/{id}/start.',
                'parameters' => [
                    'id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official UptimeRobot OpenAPI schema.',
                    ],
                ],
            ],
            'uptimerobot_psp_list' => [
                'class' => UptimeRobotPspList::class,
                'name' => 'PSP List',
                'description' => 'List PSPs

Official UptimeRobot endpoint: GET /psps.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Cursor to paginate through PSPs',
                    ],
                ],
            ],
            'uptimerobot_psp_create' => [
                'class' => UptimeRobotPspCreate::class,
                'name' => 'PSP Create',
                'description' => 'Create a PSP

Official UptimeRobot endpoint: POST /psps.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official UptimeRobot OpenAPI schema.',
                    ],
                ],
            ],
            'uptimerobot_psp_get' => [
                'class' => UptimeRobotPspGet::class,
                'name' => 'PSP Get',
                'description' => 'Get a PSP by ID

Official UptimeRobot endpoint: GET /psps/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'id',
                    ],
                ],
            ],
            'uptimerobot_psp_update' => [
                'class' => UptimeRobotPspUpdate::class,
                'name' => 'PSP Update',
                'description' => 'Update a PSP

Official UptimeRobot endpoint: PATCH /psps/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'id',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official UptimeRobot OpenAPI schema.',
                    ],
                ],
            ],
            'uptimerobot_psp_delete' => [
                'class' => UptimeRobotPspDelete::class,
                'name' => 'PSP Delete',
                'description' => 'Delete a PSP

Official UptimeRobot endpoint: DELETE /psps/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'id',
                    ],
                ],
            ],
            'uptimerobot_psp_announcements_list' => [
                'class' => UptimeRobotPspAnnouncementsList::class,
                'name' => 'PSP Announcements List',
                'description' => 'List announcements

Official UptimeRobot endpoint: GET /psps/{pspId}/announcements.',
                'parameters' => [
                    'psp_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'ID of the Public Status Page',
                    ],
                    'status' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Filter announcements by status',
                        'enum' => ['OFFLINE', 'PENDING', 'PUBLISHED', 'ARCHIVED'],
                    ],
                    'cursor' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Cursor to paginate through announcements',
                    ],
                ],
            ],
            'uptimerobot_psp_announcements_create' => [
                'class' => UptimeRobotPspAnnouncementsCreate::class,
                'name' => 'PSP Announcements Create',
                'description' => 'Create an announcement

Official UptimeRobot endpoint: POST /psps/{pspId}/announcements.',
                'parameters' => [
                    'psp_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'ID of the Public Status Page',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official UptimeRobot OpenAPI schema.',
                    ],
                ],
            ],
            'uptimerobot_psp_announcements_get' => [
                'class' => UptimeRobotPspAnnouncementsGet::class,
                'name' => 'PSP Announcements Get',
                'description' => 'Get an announcement by ID

Official UptimeRobot endpoint: GET /psps/{pspId}/announcements/{id}.',
                'parameters' => [
                    'psp_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'ID of the Public Status Page',
                    ],
                    'id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'ID of the announcement',
                    ],
                ],
            ],
            'uptimerobot_psp_announcements_update' => [
                'class' => UptimeRobotPspAnnouncementsUpdate::class,
                'name' => 'PSP Announcements Update',
                'description' => 'Update an announcement

Official UptimeRobot endpoint: PATCH /psps/{pspId}/announcements/{id}.',
                'parameters' => [
                    'psp_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'ID of the Public Status Page',
                    ],
                    'id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'ID of the announcement to update',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official UptimeRobot OpenAPI schema.',
                    ],
                ],
            ],
            'uptimerobot_psp_announcements_pin' => [
                'class' => UptimeRobotPspAnnouncementsPin::class,
                'name' => 'PSP Announcements Pin',
                'description' => 'Pin an announcement

Official UptimeRobot endpoint: POST /psps/{pspId}/announcements/{id}/pin.',
                'parameters' => [
                    'psp_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'ID of the Public Status Page',
                    ],
                    'id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'ID of the announcement to pin',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official UptimeRobot OpenAPI schema.',
                    ],
                ],
            ],
            'uptimerobot_psp_announcements_unpin' => [
                'class' => UptimeRobotPspAnnouncementsUnpin::class,
                'name' => 'PSP Announcements Unpin',
                'description' => 'Unpin an announcement

Official UptimeRobot endpoint: POST /psps/{pspId}/announcements/{id}/unpin.',
                'parameters' => [
                    'psp_id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'ID of the Public Status Page',
                    ],
                    'id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'ID of the announcement to unpin',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => false,
                        'description' => 'Request body matching the official UptimeRobot OpenAPI schema.',
                    ],
                ],
            ],
            'uptimerobot_maintenance_windows_list' => [
                'class' => UptimeRobotMaintenanceWindowsList::class,
                'name' => 'Maintenance Windows List',
                'description' => 'List maintenance windows

Official UptimeRobot endpoint: GET /maintenance-windows.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'cursor',
                    ],
                ],
            ],
            'uptimerobot_maintenance_windows_create' => [
                'class' => UptimeRobotMaintenanceWindowsCreate::class,
                'name' => 'Maintenance Windows Create',
                'description' => 'Create a maintenance window

Official UptimeRobot endpoint: POST /maintenance-windows.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official UptimeRobot OpenAPI schema.',
                    ],
                ],
            ],
            'uptimerobot_maintenance_windows_get' => [
                'class' => UptimeRobotMaintenanceWindowsGet::class,
                'name' => 'Maintenance Windows Get',
                'description' => 'Get a maintenance window by ID

Official UptimeRobot endpoint: GET /maintenance-windows/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'ID of the maintenance window',
                    ],
                ],
            ],
            'uptimerobot_maintenance_windows_update' => [
                'class' => UptimeRobotMaintenanceWindowsUpdate::class,
                'name' => 'Maintenance Windows Update',
                'description' => 'Update a maintenance window

Official UptimeRobot endpoint: PATCH /maintenance-windows/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'ID of the maintenance window',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official UptimeRobot OpenAPI schema.',
                    ],
                ],
            ],
            'uptimerobot_maintenance_windows_delete' => [
                'class' => UptimeRobotMaintenanceWindowsDelete::class,
                'name' => 'Maintenance Windows Delete',
                'description' => 'Delete a maintenance window

Official UptimeRobot endpoint: DELETE /maintenance-windows/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'id',
                    ],
                ],
            ],
            'uptimerobot_user_get_me' => [
                'class' => UptimeRobotUserGetMe::class,
                'name' => 'User Get Me',
                'description' => 'Get current user

Official UptimeRobot endpoint: GET /user/me.',
                'parameters' => [],
            ],
            'uptimerobot_user_get_alert_contacts' => [
                'class' => UptimeRobotUserGetAlertContacts::class,
                'name' => 'User Get Alert Contacts',
                'description' => 'Get alert contacts

Official UptimeRobot endpoint: GET /user/alert-contacts.',
                'parameters' => [],
            ],
            'uptimerobot_user_get_all_alert_contacts' => [
                'class' => UptimeRobotUserGetAllAlertContacts::class,
                'name' => 'User Get All Alert Contacts',
                'description' => 'Get all alert contacts

Official UptimeRobot endpoint: GET /user/all-alert-contacts.',
                'parameters' => [],
            ],
            'uptimerobot_integrations_list' => [
                'class' => UptimeRobotIntegrationsList::class,
                'name' => 'Integrations List',
                'description' => 'List Integrations

Official UptimeRobot endpoint: GET /integrations.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Cursor to paginate through the integrations',
                    ],
                ],
            ],
            'uptimerobot_integrations_create' => [
                'class' => UptimeRobotIntegrationsCreate::class,
                'name' => 'Integrations Create',
                'description' => 'Create an Integration

Official UptimeRobot endpoint: POST /integrations.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official UptimeRobot OpenAPI schema.',
                    ],
                ],
            ],
            'uptimerobot_integrations_get' => [
                'class' => UptimeRobotIntegrationsGet::class,
                'name' => 'Integrations Get',
                'description' => 'Get an integration by ID

Official UptimeRobot endpoint: GET /integrations/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'ID of the integration',
                    ],
                ],
            ],
            'uptimerobot_integrations_update' => [
                'class' => UptimeRobotIntegrationsUpdate::class,
                'name' => 'Integrations Update',
                'description' => 'Update an Integration

Official UptimeRobot endpoint: PATCH /integrations/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'ID of the integration',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official UptimeRobot OpenAPI schema.',
                    ],
                ],
            ],
            'uptimerobot_integrations_delete' => [
                'class' => UptimeRobotIntegrationsDelete::class,
                'name' => 'Integrations Delete',
                'description' => 'Delete an Integration

Official UptimeRobot endpoint: DELETE /integrations/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'id',
                    ],
                ],
            ],
            'uptimerobot_tags_get_tags' => [
                'class' => UptimeRobotTagsGetTags::class,
                'name' => 'Tags Get Tags',
                'description' => 'List user tags

Official UptimeRobot endpoint: GET /tags.',
                'parameters' => [
                    'cursor' => [
                        'type' => 'number',
                        'required' => false,
                        'description' => 'Cursor for pagination',
                    ],
                ],
            ],
            'uptimerobot_tags_delete_tag' => [
                'class' => UptimeRobotTagsDeleteTag::class,
                'name' => 'Tags Delete Tag',
                'description' => 'Delete a tag

Official UptimeRobot endpoint: DELETE /tags/{id}.',
                'parameters' => [
                    'id' => [
                        'type' => 'number',
                        'required' => true,
                        'description' => 'Tag ID to delete',
                    ],
                ],
            ],
        ]; }

    /** @param  array<string, mixed>  $context  Runtime account context. */
    public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); }

    /** @param  array<string, mixed>  $context  Runtime account context. */
    private function resolveService(array $context = []): UptimeRobotService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);
            return new UptimeRobotService(apiKey: $creds->get('uptimerobot', 'api_key', '', $account), baseUrl: $creds->get('uptimerobot', 'url', 'https://api.uptimerobot.com/v3', $account));
        }

        return app(UptimeRobotService::class);
    }

    public function luaDocsPath(): ?string { return __DIR__ . '/../lua-docs/uptimerobot.md'; }
    public function isIntegration(): bool { return true; }
}
