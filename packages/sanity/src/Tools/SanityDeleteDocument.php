<?php

namespace OpenCompany\Integrations\Sanity\Tools;

use OpenCompany\Integrations\Sanity\SanityService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SanityDeleteDocument implements Tool
{
    public function __construct(
        private SanityService $service,
    ) {}

    public function name(): string
    {
        return 'sanity_delete_document';
    }

    public function description(): string
    {
        return 'Delete a document from the Sanity dataset by its ID. This action is permanent.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The document ID to delete (e.g., "post-123").'],
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

            $result = $this->service->deleteDocument($id);

            return ToolResult::success([
                'message' => "Document '{$id}' has been deleted.",
                'result' => $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
