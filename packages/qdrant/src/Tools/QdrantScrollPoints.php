<?php

namespace OpenCompany\Integrations\Qdrant\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Qdrant\QdrantService;

/**
 * Scroll through Qdrant points page by page.
 */
class QdrantScrollPoints implements Tool
{
    /**
     * @param  QdrantService  $service  The Qdrant REST API client.
     */
    public function __construct(private QdrantService $service) {}

    public function name(): string
    {
        return 'qdrant_scroll_points';
    }

    public function description(): string
    {
        return 'Scroll Qdrant points with optional filters, payload selection, and offset pagination.';
    }

    public function parameters(): array
    {
        return [
            'collection' => ['type' => 'string', 'required' => true, 'description' => 'Collection name.'],
            'filter' => ['type' => 'object', 'description' => 'Optional filter.'],
            'limit' => ['type' => 'integer', 'description' => 'Page size.'],
            'offset' => ['type' => 'string', 'description' => 'Next offset from the previous response.'],
            'with_payload' => ['type' => 'boolean', 'description' => 'Include payloads.'],
            'with_vector' => ['type' => 'boolean', 'description' => 'Include vectors.'],
        ];
    }

    /**
     * Scroll points.
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

            return ToolResult::success($this->service->scrollPoints($collection, $args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
