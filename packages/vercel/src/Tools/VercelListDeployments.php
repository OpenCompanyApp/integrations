<?php

namespace OpenCompany\Integrations\Vercel\Tools;

use OpenCompany\Integrations\Core\Contracts\Tool;
use OpenCompany\Integrations\Core\Support\ToolResult;
use OpenCompany\Integrations\Vercel\VercelService;

class VercelListDeployments implements Tool
{
    public function __construct(private VercelService $service)
    {
    }

    public function name(): string
    {
        return 'vercel_list_deployments';
    }

    public function description(): string
    {
        return 'List deployments across your Vercel projects. Filter by project, state, or target.';
    }

    public function parameters(): array
    {
        return [
            'project_id' => [
                'type' => 'string',
                'required' => false,
                'description' => 'Filter deployments by project ID.',
            ],
            'state' => [
                'type' => 'string',
                'required' => false,
                'description' => 'Filter by deployment state (e.g., READY, ERROR, BUILDING, QUEUED).',
            ],
            'target' => [
                'type' => 'string',
                'required' => false,
                'description' => 'Filter by target environment (e.g., production, preview, development).',
            ],
            'limit' => [
                'type' => 'integer',
                'required' => false,
                'description' => 'Maximum number of deployments to return (default 20, max 100).',
            ],
            'team_id' => [
                'type' => 'string',
                'required' => false,
                'description' => 'Optional team ID to scope deployments to a specific team.',
            ],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Vercel is not configured. Please set your API token.');
            }

            $params = array_filter([
                'projectId' => $args['project_id'] ?? null,
                'state' => $args['state'] ?? null,
                'target' => $args['target'] ?? null,
                'limit' => $args['limit'] ?? null,
                'teamId' => $args['team_id'] ?? null,
            ], fn ($v) => $v !== null);

            $result = $this->service->listDeployments($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error('Failed to list Vercel deployments: ' . $e->getMessage());
        }
    }
}
