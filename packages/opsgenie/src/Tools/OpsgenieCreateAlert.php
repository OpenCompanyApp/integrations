<?php

namespace OpenCompany\Integrations\Opsgenie\Tools;

use OpenCompany\Integrations\Opsgenie\OpsgenieService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to create a new Opsgenie alert.
 *
 * Creates an alert with the specified message, priority, and optional
 * routing to teams, users, or schedules.
 */
class OpsgenieCreateAlert implements Tool
{
    /**
     * Create a new OpsgenieCreateAlert tool instance.
     *
     * @param  OpsgenieService  $service  The Opsgenie API service
     */
    public function __construct(
        private OpsgenieService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'opsgenie_create_alert';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Create a new Opsgenie alert. Specify message, priority (P1–P5), and optional description, alias, tags, teams, or recipients.';
    }

    /**
     * Get the tool parameters schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'message' => ['type' => 'string', 'required' => true, 'description' => 'Alert message text.'],
            'alias' => ['type' => 'string', 'description' => 'Client-defined identifier for the alert (used for deduplication).'],
            'description' => ['type' => 'string', 'description' => 'Detailed description of the alert.'],
            'priority' => ['type' => 'string', 'description' => 'Alert priority: "P1", "P2", "P3", "P4", or "P5". Defaults to "P3".'],
            'teams' => ['type' => 'array', 'description' => 'List of team names to route the alert to (e.g., ["ops", "engineering"]).'],
            'visibleTo' => ['type' => 'array', 'description' => 'List of teams/users the alert will be visible to without sending notifications.'],
            'actions' => ['type' => 'array', 'description' => 'Custom actions available on the alert (e.g., ["Restart", "ScaleUp"]).'],
            'tags' => ['type' => 'array', 'description' => 'List of tags for the alert (e.g., ["production", "critical"]).'],
            'details' => ['type' => 'object', 'description' => 'Key-value map of additional alert details.'],
            'entity' => ['type' => 'string', 'description' => 'Entity field used to specify the domain of the alert.'],
            'source' => ['type' => 'string', 'description' => 'Source field of the alert (e.g., "monitoring", "custom").'],
            'user' => ['type' => 'string', 'description' => 'Display name of the request owner.'],
            'note' => ['type' => 'string', 'description' => 'Additional note to add to the alert.'],
        ];
    }

    /**
     * Execute the tool and create the alert.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Opsgenie integration is not configured.');
            }

            $body = [
                'message' => $args['message'],
            ];

            if (isset($args['alias'])) {
                $body['alias'] = $args['alias'];
            }

            if (isset($args['description'])) {
                $body['description'] = $args['description'];
            }

            if (isset($args['priority'])) {
                $body['priority'] = $args['priority'];
            }

            if (isset($args['teams'])) {
                $body['teams'] = $args['teams'];
            }

            if (isset($args['visibleTo'])) {
                $body['visibleTo'] = $args['visibleTo'];
            }

            if (isset($args['actions'])) {
                $body['actions'] = $args['actions'];
            }

            if (isset($args['tags'])) {
                $body['tags'] = $args['tags'];
            }

            if (isset($args['details'])) {
                $body['details'] = $args['details'];
            }

            if (isset($args['entity'])) {
                $body['entity'] = $args['entity'];
            }

            if (isset($args['source'])) {
                $body['source'] = $args['source'];
            }

            if (isset($args['user'])) {
                $body['user'] = $args['user'];
            }

            if (isset($args['note'])) {
                $body['note'] = $args['note'];
            }

            $result = $this->service->createAlert($body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
