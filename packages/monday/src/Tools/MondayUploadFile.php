<?php

namespace OpenCompany\Integrations\Monday\Tools;

use OpenCompany\Integrations\Monday\MondayService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Upload a file to a column on a Monday.com item.
 *
 * Uses the `add_file_to_column` mutation to upload file content
 * (base64-encoded) to a file column on an item.
 */
class MondayUploadFile implements Tool
{
    /**
     * @param  MondayService  $service  The Monday.com API client
     */
    public function __construct(
        private MondayService $service,
    ) {}

    public function name(): string
    {
        return 'monday_upload_file';
    }

    public function description(): string
    {
        return 'Upload a file to a column on a Monday.com item.';
    }

    public function parameters(): array
    {
        return [
            'item_id'      => ['type' => 'integer', 'required' => true, 'description' => 'The ID of the item to upload the file to.'],
            'column_id'    => ['type' => 'string',  'required' => true, 'description' => 'The ID of the file column.'],
            'file_content' => ['type' => 'string',  'required' => true, 'description' => 'Base64-encoded file content.'],
            'file_name'    => ['type' => 'string',  'required' => true, 'description' => 'The name of the file including extension.'],
        ];
    }

    /**
     * Upload a file to a specific column on an item.
     *
     * @param  array<string, mixed>  $args  Tool arguments (item_id, column_id, file_content, file_name)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Monday.com integration is not configured.');
            }

            $itemId = $args['item_id'] ?? null;
            $columnId = $args['column_id'] ?? '';
            $fileContent = $args['file_content'] ?? '';
            $fileName = $args['file_name'] ?? '';

            if (empty($itemId)) {
                return ToolResult::error('item_id is required.');
            }

            if (empty($columnId)) {
                return ToolResult::error('column_id is required.');
            }

            if (empty($fileContent)) {
                return ToolResult::error('file_content is required.');
            }

            if (empty($fileName)) {
                return ToolResult::error('file_name is required.');
            }

            $escapedFileName = $this->escapeGraphQL($fileName);

            $query = "mutation (\$file: File!) { add_file_to_column (item_id: {$itemId}, column_id: \"{$this->escapeGraphQL($columnId)}\", file: \$file) { id } }";

            $variables = [
                'file' => $fileContent,
                'fileName' => $fileName,
            ];

            $result = $this->service->graphql($query, $variables);

            return ToolResult::success($result['add_file_to_column'] ?? []);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Escape a string for safe embedding in a GraphQL query.
     *
     * @param  string  $value  The raw string value
     * @return string  The escaped string
     */
    private function escapeGraphQL(string $value): string
    {
        return str_replace(
            ['\\', '"', "\n", "\r", "\t"],
            ['\\\\', '\\"', '\\n', '\\r', '\\t'],
            $value,
        );
    }
}
