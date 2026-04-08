<?php

namespace OpenCompany\Integrations\Sanity\Tools;

use OpenCompany\Integrations\Sanity\SanityService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SanityUpdateDocument implements Tool
{
    public function __construct(
        private SanityService $service,
    ) {}

    public function name(): string
    {
        return 'sanity_update_document';
    }

    public function description(): string
    {
        return 'Update an existing Sanity document by applying a patch with the specified fields.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The document ID to update (e.g., "post-123").'],
            'set' => ['type' => 'object', 'required' => true, 'description' => 'Fields to update as a JSON object (e.g., {"title": "Updated Title", "published": true}). Only the specified fields are changed.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Sanity integration is not configured.');
            }

            $id = $args['id'] ?? '';
            $set = $args['set'] ?? [];

            if (empty($id)) {
                return ToolResult::error('The "id" parameter is required.');
            }

            if (empty($set)) {
                return ToolResult::error('The "set" parameter is required and must contain at least one field to update.');
            }

            $result = $this->service->updateDocument($id, $set);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
