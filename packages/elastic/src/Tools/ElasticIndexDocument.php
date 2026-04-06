<?php

namespace OpenCompany\Integrations\Elastic\Tools;

use OpenCompany\Integrations\Elastic\ElasticService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ElasticIndexDocument implements Tool
{
    /**
     * @param  ElasticService  $service  The Elasticsearch service instance
     */
    public function __construct(
        private ElasticService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'elastic_index_document';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'Create or update a document in an Elasticsearch index. Provide an ID to update an existing document, or omit it to let Elasticsearch auto-generate one.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'index' => ['type' => 'string', 'required' => true, 'description' => 'The target index name.'],
            'document' => ['type' => 'object', 'required' => true, 'description' => 'The document body to index. Example: {"title": "My Document", "content": "Hello world"}'],
            'id' => ['type' => 'string', 'description' => 'Optional document ID. If provided, the document is created or replaced with this ID. If omitted, Elasticsearch auto-generates an ID.'],
        ];
    }

    /**
     * Execute the tool and return the result.
     *
     * @param  array<string, mixed>  $args  The tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Elasticsearch integration is not configured.');
            }

            $index = $args['index'] ?? '';
            if (empty($index)) {
                return ToolResult::error('The "index" parameter is required.');
            }

            $document = $args['document'] ?? null;
            if (empty($document)) {
                return ToolResult::error('The "document" parameter is required.');
            }

            if (is_string($document)) {
                $document = json_decode($document, true);
            }

            $id = $args['id'] ?? null;

            $result = $this->service->indexDocument($index, $id, $document);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
