<?php

namespace OpenCompany\Integrations\Qdrant\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Qdrant\QdrantService;

/**
 * Count Qdrant points matching an optional filter.
 */
class QdrantCountPoints implements Tool
{
    /**
     * @param  QdrantService  $service  The Qdrant REST API client.
     */
    public function __construct(private QdrantService $service) {}

    public function name(): string
    {
        return 'qdrant_count_points';
    }

    public function description(): string
    {
        return 'Count points in a Qdrant collection, optionally matching a filter exactly or approximately.';
    }

    public function parameters(): array
    {
        return [
            'collection' => ['type' => 'string', 'required' => true, 'description' => 'Collection name.'],
            'filter' => ['type' => 'object', 'description' => 'Optional filter.'],
            'exact' => ['type' => 'boolean', 'description' => 'Whether to count exactly.'],
        ];
    }

    /**
     * Count points.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Qdrant integration is not configured.');
            }

            $collection = (string) ($args['collection'] ?? '');
            unset($args['collection']);

            return ToolResult::success($this->service->countPoints($collection, $args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
