<?php

namespace OpenCompany\Integrations\Railway\Tools;

use OpenCompany\Integrations\Railway\RailwayService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details for a Railway service.
 *
 * Includes source and repository fields when available from Railway.
 */
class RailwayGetService implements Tool
{
    /**
     * @param  RailwayService  $service  The Railway GraphQL API client.
     */
    public function __construct(
        private RailwayService $service,
    ) {}

    public function name(): string
    {
        return 'railway_get_service';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific Railway service, including its source configuration and repository details.';
    }

    public function parameters(): array
    {
        return [
            'service_id' => ['type' => 'string', 'required' => true, 'description' => 'The Railway service ID.'],
        ];
    }

    /**
     * Fetch a service by ID and return normalized service details.
     *
     * @param  array<string, mixed>  $args  Tool arguments (service_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Railway integration is not configured.');
            }

            if (empty($args['service_id'])) {
                return ToolResult::error('The service_id parameter is required.');
            }

            $result = $this->service->getService($args['service_id']);

            $service = $result['service'] ?? $result;

            return ToolResult::success([
                'id' => $service['id'] ?? '',
                'name' => $service['name'] ?? '',
                'is_forked' => $service['isForked'] ?? false,
                'repo' => [
                    'id' => $service['repo']['id'] ?? null,
                    'name' => $service['repo']['name'] ?? null,
                    'full_name' => $service['repo']['fullName'] ?? null,
                    'branch' => $service['repo']['branch'] ?? null,
                ],
                'source' => $service['source'] ?? null,
                'created_at' => $service['createdAt'] ?? null,
                'updated_at' => $service['updatedAt'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
