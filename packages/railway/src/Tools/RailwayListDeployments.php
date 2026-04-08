<?php

namespace OpenCompany\Integrations\Railway\Tools;

use OpenCompany\Integrations\Railway\RailwayService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class RailwayListDeployments implements Tool
{
    public function __construct(
        private RailwayService $service,
    ) {}

    public function name(): string
    {
        return 'railway_list_deployments';
    }

    public function description(): string
    {
        return 'List deployments for a Railway service. Returns deployment status, environment, and creator info.';
    }

    public function parameters(): array
    {
        return [
            'service_id' => ['type' => 'string', 'required' => true, 'description' => 'The Railway service ID.'],
            'environment_id' => ['type' => 'string', 'description' => 'Optional environment ID to filter deployments.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of deployments to return (default: 20).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Railway integration is not configured.');
            }

            if (empty($args['service_id'])) {
                return ToolResult::error('The service_id parameter is required.');
            }

            $environmentId = $args['environment_id'] ?? null;
            $limit = isset($args['limit']) ? (int) $args['limit'] : 20;

            $result = $this->service->listDeployments($args['service_id'], $environmentId, $limit);

            $edges = $result['deployments']['edges'] ?? [];

            $deployments = array_map(function (array $edge): array {
                $node = $edge['node'] ?? $edge;

                return [
                    'id' => $node['id'] ?? '',
                    'status' => $node['status'] ?? '',
                    'environment' => $node['environment']['name'] ?? null,
                    'environment_id' => $node['environment']['id'] ?? null,
                    'service' => $node['service']['name'] ?? null,
                    'creator' => $node['creator']['name'] ?? null,
                    'creator_email' => $node['creator']['email'] ?? null,
                    'created_at' => $node['createdAt'] ?? null,
                    'updated_at' => $node['updatedAt'] ?? null,
                ];
            }, $edges);

            return ToolResult::success([
                'deployments' => $deployments,
                'count' => count($deployments),
                'limit' => $limit,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
