<?php

namespace OpenCompany\Integrations\Qdrant\Tools;

use OpenCompany\Integrations\Qdrant\QdrantService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Insert or update Qdrant points.
 */
class QdrantUpsertPoints implements Tool
{
    /**
     * @param  QdrantService  $service  The Qdrant REST API client.
     */
    public function __construct(
        private QdrantService $service,
    ) {}

    public function name(): string
    {
        return 'qdrant_upsert_points';
    }

    public function description(): string
    {
        return 'Insert or update points (vectors with optional payloads) in a Qdrant collection. Each point requires an ID and a vector. Payloads are optional metadata.';
    }

    public function parameters(): array
    {
        return [
            'collection' => ['type' => 'string', 'required' => true, 'description' => 'The collection name to upsert points into.'],
            'points' => ['type' => 'array', 'required' => true, 'description' => 'Array of point objects. Each point must have "id" (integer or UUID string), "vector" (array of floats), and optionally "payload" (object with metadata).'],
            'wait' => ['type' => 'boolean', 'description' => 'Whether to wait for the operation to complete (default: true).'],
            'ordering' => ['type' => 'string', 'description' => 'Write ordering guarantee: "weak" or "strong" (default: "weak").'],
        ];
    }

    /**
     * Upsert points into a collection.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Qdrant integration is not configured.');
            }

            if (empty($args['collection'])) {
                return ToolResult::error('The "collection" parameter is required.');
            }

            if (empty($args['points'])) {
                return ToolResult::error('The "points" parameter is required. Provide an array of point objects with "id" and "vector".');
            }

            $body = [];

            $points = $args['points'];
            if (is_string($points)) {
                $points = json_decode($points, true);
                if ($points === null) {
                    return ToolResult::error('Invalid JSON in "points" parameter.');
                }
            }
            $body['points'] = $points;

            $params = [];
            $params['wait'] = isset($args['wait']) ? (bool) $args['wait'] : null;
            $params['ordering'] = $args['ordering'] ?? null;

            $result = $this->service->upsertPoints($args['collection'], $body, $params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
