<?php

namespace OpenCompany\Integrations\Typesense\Tools;

use OpenCompany\Integrations\Typesense\TypesenseService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class TypesenseGetDocument implements Tool
{
    public function __construct(
        private TypesenseService $service,
    ) {}

    public function name(): string
    {
        return 'typesense_get_document';
    }

    public function description(): string
    {
        return 'Retrieve a single document from a Typesense collection by its ID.';
    }

    public function parameters(): array
    {
        return [
            'collection' => ['type' => 'string', 'required' => true, 'description' => 'The name of the collection containing the document.'],
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the document to retrieve.'],
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

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('The "id" parameter is required.');
            }

            $result = $this->service->getDocument($collection, $id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
