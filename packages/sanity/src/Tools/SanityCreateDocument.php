<?php

namespace OpenCompany\Integrations\Sanity\Tools;

use OpenCompany\Integrations\Sanity\SanityService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SanityCreateDocument implements Tool
{
    public function __construct(
        private SanityService $service,
    ) {}

    public function name(): string
    {
        return 'sanity_create_document';
    }

    public function description(): string
    {
        return 'Create a new document in the Sanity dataset. The document data must include a _type field matching a schema type.';
    }

    public function parameters(): array
    {
        return [
            'document' => ['type' => 'object', 'required' => true, 'description' => 'Document data as a JSON object. Must include a "_type" field (e.g., {"_type": "post", "title": "Hello", "body": "World"}).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Sanity integration is not configured.');
            }

            $document = $args['document'] ?? [];
            if (empty($document)) {
                return ToolResult::error('The "document" parameter is required.');
            }

            if (!isset($document['_type'])) {
                return ToolResult::error('The document must include a "_type" field matching a schema type in your Sanity project.');
            }

            $result = $this->service->createDocument($document);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
