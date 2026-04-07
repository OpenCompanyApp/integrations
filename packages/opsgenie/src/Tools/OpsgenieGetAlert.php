<?php

namespace OpenCompany\Integrations\Opsgenie\Tools;

use OpenCompany\Integrations\Opsgenie\OpsgenieService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get details of a specific Opsgenie alert.
 *
 * Returns the full alert object including message, description, priority,
 * status, alias, tags, and recipient information.
 */
class OpsgenieGetAlert implements Tool
{
    /**
     * Create a new OpsgenieGetAlert tool instance.
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
        return 'opsgenie_get_alert';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Get full details of a specific Opsgenie alert by its ID. Returns message, description, priority, status, tags, and recipients.';
    }

    /**
     * Get the tool parameters schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'alert_id' => ['type' => 'string', 'required' => true, 'description' => 'The Opsgenie alert ID.'],
        ];
    }

    /**
     * Execute the tool and return the alert details.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Opsgenie integration is not configured.');
            }

            $alertId = $args['alert_id'] ?? '';

            if (empty($alertId)) {
                return ToolResult::error('Alert ID is required.');
            }

            $result = $this->service->getAlert($alertId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
