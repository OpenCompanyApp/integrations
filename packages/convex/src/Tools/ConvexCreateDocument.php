<?php

namespace OpenCompany\Integrations\Convex\Tools;

use OpenCompany\Integrations\Convex\ConvexService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new document in a Convex table.
 */
class ConvexCreateDocument implements Tool
{
    /**
     * @param  ConvexService  $service  The Convex API client
     */
    public function __construct(
        private ConvexService $service,
    ) {}

    public function name(): string
    {
        return 'convex_create_document';
    }

    public function description(): string
    {
        return 'Create a new document in a Convex table.';
    }

    public function parameters(): array
    {
        return [
            'table'  => ['type' => 'string', 'required' => true, 'description' => 'Table name.'],
            'fields' => ['type' => 'string', 'required' => true, 'description' => 'JSON object of field name → value pairs (e.g., {"name":"John","age":30}).'],
        ];
    }

    /**
     * Create a new document with the given field values.
     *
     * @param  array<string, mixed>  $args  Tool arguments (table, fields)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Convex integration is not configured.');
            }

            $table = $args['table'] ?? '';
            $fields = $args['fields'] ?? '';

            if (empty($table)) {
                return ToolResult::error('table is required.');
            }
            if (empty($fields)) {
                return ToolResult::error('fields is required.');
            }

            $fieldsArray = is_string($fields) ? json_decode($fields, true) : $fields;

            if (! is_array($fieldsArray)) {
                return ToolResult::error('fields must be a valid JSON object.');
            }

            $result = $this->service->createDocument($table, $fieldsArray);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
