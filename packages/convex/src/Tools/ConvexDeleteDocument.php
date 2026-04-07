<?php

namespace OpenCompany\Integrations\Convex\Tools;

use OpenCompany\Integrations\Convex\ConvexService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a document from a Convex table.
 */
class ConvexDeleteDocument implements Tool
{
    /**
     * @param  ConvexService  $service  The Convex API client
     */
    public function __construct(
        private ConvexService $service,
    ) {}

    public function name(): string
    {
        return 'convex_delete_document';
    }

    public function description(): string
    {
        return 'Delete a document from a Convex table.';
    }

    public function parameters(): array
    {
        return [
            'table'       => ['type' => 'string', 'required' => true, 'description' => 'Table name.'],
            'document_id' => ['type' => 'string', 'required' => true, 'description' => 'Document ID.'],
        ];
    }

    /**
     * Delete a document by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (table, document_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Convex integration is not configured.');
            }

            $table = $args['table'] ?? '';
            $documentId = $args['document_id'] ?? '';

            if (empty($table)) {
                return ToolResult::error('table is required.');
            }
            if (empty($documentId)) {
                return ToolResult::error('document_id is required.');
            }

            $result = $this->service->deleteDocument($table, $documentId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
