<?php

namespace OpenCompany\Integrations\Qdrant\Tools;

use OpenCompany\Integrations\Qdrant\QdrantService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class QdrantSearch implements Tool
{
    public function __construct(
        private QdrantService $service,
    ) {}

    public function name(): string
    {
        return 'qdrant_search';
    }

    public function description(): string
    {
        return 'Search for the closest vectors in a Qdrant collection. Supports vector similarity search with optional filtering, payload selection, and scoring.';
    }

    public function parameters(): array
    {
        return [
            'collection' => ['type' => 'string', 'required' => true, 'description' => 'The collection name to search in.'],
            'vector' => ['type' => 'array', 'description' => 'The query vector (array of floats). Use this for direct vector search.'],
            'vector_name' => ['type' => 'string', 'description' => 'Named vector to search against (for multi-vector collections).'],
            'filter' => ['type' => 'object', 'description' => 'Filter conditions to narrow results. JSON object with "must", "should", "must_not" clauses.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of results to return (default: 10).'],
            'offset' => ['type' => 'integer', 'description' => 'Offset for pagination.'],
            'with_payload' => ['type' => 'boolean', 'description' => 'Whether to include point payloads in results (default: true).'],
            'with_vectors' => ['type' => 'boolean', 'description' => 'Whether to include vectors in results (default: false).'],
            'score_threshold' => ['type' => 'number', 'description' => 'Minimum similarity score threshold. Results below this are excluded.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Qdrant integration is not configured.');
            }

            if (empty($args['collection'])) {
                return ToolResult::error('The "collection" parameter is required.');
            }

            if (empty($args['vector'])) {
                return ToolResult::error('The "vector" parameter is required. Provide an array of floats representing the query vector.');
            }

            $body = [];

            // Handle vector — can be a named vector lookup or plain array
            $vector = $args['vector'];
            if (is_string($vector)) {
                $vector = json_decode($vector, true);
                if ($vector === null) {
                    return ToolResult::error('Invalid JSON in "vector" parameter.');
                }
            }

            // If a vector_name is provided, wrap in named format
            if (isset($args['vector_name'])) {
                $body['vector'] = [
                    'name' => $args['vector_name'],
                    'vector' => $vector,
                ];
            } else {
                $body['vector'] = $vector;
            }

            // Optional filter
            if (isset($args['filter'])) {
                $filter = $args['filter'];
                $body['filter'] = is_string($filter) ? json_decode($filter, true) : $filter;
            }

            // Optional parameters
            if (isset($args['limit'])) {
                $body['limit'] = (int) $args['limit'];
            }

            if (isset($args['offset'])) {
                $body['offset'] = (int) $args['offset'];
            }

            if (isset($args['with_payload'])) {
                $body['with_payload'] = (bool) $args['with_payload'];
            }

            if (isset($args['with_vectors'])) {
                $body['with_vectors'] = (bool) $args['with_vectors'];
            }

            if (isset($args['score_threshold'])) {
                $body['score_threshold'] = (float) $args['score_threshold'];
            }

            $result = $this->service->search($args['collection'], $body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
