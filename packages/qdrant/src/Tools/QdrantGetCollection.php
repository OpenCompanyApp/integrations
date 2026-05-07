<?php

namespace OpenCompany\Integrations\Qdrant\Tools;

use OpenCompany\Integrations\Qdrant\QdrantService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve Qdrant collection configuration and telemetry.
 */
class QdrantGetCollection implements Tool
{
    /**
     * @param  QdrantService  $service  The Qdrant REST API client.
     */
    public function __construct(
        private QdrantService $service,
    ) {}

    public function name(): string
    {
        return 'qdrant_get_collection';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific Qdrant collection, including vector configuration, index status, and point count.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The name of the collection to retrieve.'],
        ];
    }

    /**
     * Retrieve a collection by name.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Qdrant integration is not configured.');
            }

            if (empty($args['name'])) {
                return ToolResult::error('The "name" parameter is required.');
            }

            $result = $this->service->getCollection($args['name']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
