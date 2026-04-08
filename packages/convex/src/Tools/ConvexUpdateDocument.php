<?php

namespace OpenCompany\Integrations\Convex\Tools;

use OpenCompany\Integrations\Convex\ConvexService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing document in a Convex table.
 */
class ConvexUpdateDocument implements Tool
{
    /**
     * @param  ConvexService  $service  The Convex API client
     */
    public function __construct(
        private ConvexService $service,
    ) {}

    public function name(): string
    {
        return 'convex_update_document';
    }

    public function description(): string
    {
        return 'Update an existing document in a Convex table.';
    }

    public function parameters(): array
    {
        return [
            'table'       => ['type' => 'string', 'required' => true, 'description' => 'Table name.'],
            'document_id' => ['type' => 'string', 'required' => true, 'description' => 'Document ID.'],
            'fields'      => ['type' => 'string', 'required' => true, 'description' => 'JSON object of field name → value pairs to update.'],
        ];
    }

    /**
     * Update a document by ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (table, document_id, fields)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Convex integration is not configured.');
            }

            $table = $args['table'] ?? '';
            $documentId = $args['document_id'] ?? '';
            $fields = $args['fields'] ?? '';

            if (empty($table)) {
                return ToolResult::error('table is required.');
            }
            if (empty($documentId)) {
                return ToolResult::error('document_id is required.');
            }
            if (empty($fields)) {
                return ToolResult::error('fields is required.');
            }

            $fieldsArray = is_string($fields) ? json_decode($fields, true) : $fields;

            if (! is_array($fieldsArray)) {
                return ToolResult::error('fields must be a valid JSON object.');
            }

            $result = $this->service->updateDocument($table, $documentId, $fieldsArray);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
