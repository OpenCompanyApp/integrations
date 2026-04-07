<?php

namespace OpenCompany\Integrations\Milvus\Tools;

use OpenCompany\Integrations\Milvus\MilvusService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class MilvusSearchDocuments implements Tool
{
    public function __construct(
        private MilvusService $service,
    ) {}

    public function name(): string
    {
        return 'milvus_search_documents';
    }

    public function description(): string
    {
        return 'Search for similar documents in a Milvus collection using a query vector. Returns the most similar documents ranked by distance or similarity.';
    }

    public function parameters(): array
    {
        return [
            'collection_name' => ['type' => 'string', 'required' => true, 'description' => 'The name of the collection to search.'],
            'vector' => ['type' => 'array', 'required' => true, 'description' => 'The query embedding vector (array of floats).'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of results to return (default: 10).'],
            'output_fields' => ['type' => 'array', 'description' => 'Fields to include in the response, e.g. ["id", "color", "text"].'],
            'filter' => ['type' => 'string', 'description' => 'Filter expression for scalar fields, e.g. \'color == "red"\'.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Milvus integration is not configured.');
            }

            $collectionName = $args['collection_name'] ?? '';
            if (empty($collectionName)) {
                return ToolResult::error('collection_name is required.');
            }

            $vector = $args['vector'] ?? [];
            if (empty($vector)) {
                return ToolResult::error('vector is required.');
            }

            $body = [
                'vector' => $vector,
            ];

            if (isset($args['limit'])) {
                $body['limit'] = (int) $args['limit'];
            }

            if (isset($args['output_fields'])) {
                $body['outputFields'] = $args['output_fields'];
            }

            if (isset($args['filter'])) {
                $body['filter'] = $args['filter'];
            }

            $result = $this->service->searchDocuments($collectionName, $body);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
