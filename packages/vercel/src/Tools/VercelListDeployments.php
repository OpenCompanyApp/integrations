<?php

namespace OpenCompany\Integrations\Vercel\Tools;

use OpenCompany\Integrations\Vercel\VercelService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List deployments from Vercel.
 *
 * Supports optional filtering by project ID, state, and pagination.
 * Wraps <code>GET /v13/deployments</code>.
 */
class VercelListDeployments implements Tool
{
    public function __construct(
        private VercelService $service,
    ) {}

    public function name(): string
    {
        return 'vercel_list_deployments';
    }

    public function description(): string
    {
        return 'List deployments from Vercel. Optionally filter by project ID or deployment state (QUEUED, BUILDING, READY, ERROR, CANCELED). Returns deployment IDs, states, URLs, and creation timestamps.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => ['type' => 'string', 'description' => 'Filter deployments to a specific project ID.'],
            'state' => ['type' => 'string', 'description' => 'Filter by deployment state: QUEUED, BUILDING, READY, ERROR, or CANCELED.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of deployments to return (default: 20, max: 100).'],
            'from' => ['type' => 'string', 'description' => 'Pagination cursor — deployment ID from a previous response to start after.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Vercel integration is not configured.');
            }

            $params = [];

            if (isset($args['project_id'])) {
                $params['projectId'] = $args['project_id'];
            }

            if (isset($args['state'])) {
                $params['state'] = $args['state'];
            }

            if (isset($args['limit'])) {
                $params['limit'] = min((int) $args['limit'], 100);
            }

            if (isset($args['from'])) {
                $params['from'] = $args['from'];
            }

            $result = $this->service->listDeployments($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
