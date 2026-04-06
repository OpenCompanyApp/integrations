<?php

namespace OpenCompany\Integrations\Typesense\Tools;

use OpenCompany\Integrations\Typesense\TypesenseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class TypesenseIndexDocument implements Tool
{
    public function __construct(
        private TypesenseService $service,
    ) {}

    public function name(): string
    {
        return 'typesense_index_document';
    }

    public function description(): string
    {
        return 'Index (create or update) a document in a Typesense collection. The document must conform to the collection\'s schema.';
    }

    public function parameters(): array
    {
        return [
            'collection' => ['type' => 'string', 'required' => true, 'description' => 'The name of the collection to index the document into.'],
            'document' => ['type' => 'object', 'required' => true, 'description' => 'The document data to index. Must include an "id" field matching the collection schema.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Typesense integration is not configured.');
            }

            $collection = $args['collection'] ?? '';
            if (empty($collection)) {
                return ToolResult::error('The "collection" parameter is required.');
            }

            $document = $args['document'] ?? [];
            if (empty($document)) {
                return ToolResult::error('The "document" parameter is required and must be a non-empty object.');
            }

            $result = $this->service->indexDocument($collection, $document);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
