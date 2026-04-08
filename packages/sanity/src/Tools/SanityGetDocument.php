<?php

namespace OpenCompany\Integrations\Sanity\Tools;

use OpenCompany\Integrations\Sanity\SanityService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SanityGetDocument implements Tool
{
    public function __construct(
        private SanityService $service,
    ) {}

    public function name(): string
    {
        return 'sanity_get_document';
    }

    public function description(): string
    {
        return 'Retrieve a single Sanity document by its ID. Returns the full document with all fields.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The document ID (e.g., "post-123" or a draft ID like "drafts.post-123").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Sanity integration is not configured.');
            }

            $id = $args['id'] ?? '';
            if (empty($id)) {
                return ToolResult::error('The "id" parameter is required.');
            }

            $result = $this->service->getDocument($id);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
