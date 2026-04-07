<?php

namespace OpenCompany\Integrations\Chroma\Tools;

use OpenCompany\Integrations\Chroma\ChromaService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class ChromaCreateCollection implements Tool
{
    public function __construct(
        private ChromaService $service,
    ) {}

    public function name(): string
    {
        return 'chroma_create_collection';
    }

    public function description(): string
    {
        return 'Create a new vector collection in Chroma. Collections are used to store and query document embeddings.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The name of the collection to create.'],
            'description' => ['type' => 'string', 'description' => 'An optional description of the collection.'],
            'metadata' => ['type' => 'object', 'description' => 'Optional metadata to attach to the collection (JSON object with string values).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Chroma integration is not configured.');
            }

            $name = $args['name'] ?? '';
            if (empty($name)) {
                return ToolResult::error('name is required.');
            }

            $result = $this->service->createCollection(
                name: $name,
                description: $args['description'] ?? null,
                metadata: $args['metadata'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
