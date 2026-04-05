<?php

namespace OpenCompany\Integrations\Smartsheet\Tools;

use OpenCompany\Integrations\Smartsheet\SmartsheetService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete one or more rows from a Smartsheet sheet.
 */
class SmartsheetDeleteRows implements Tool
{
    /**
     * Create a new SmartsheetDeleteRows tool instance.
     *
     * @param SmartsheetService $service The Smartsheet API client.
     */
    public function __construct(private SmartsheetService $service) {}

    /**
     * Get the tool name identifier.
     *
     * @return string The tool name.
     */
    public function name(): string
    {
        return 'smartsheet_delete_rows';
    }

    /**
     * Get the human-readable tool description.
     *
     * @return string The tool description.
     */
    public function description(): string
    {
        return 'Delete one or more rows from a Smartsheet sheet by their row IDs.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, description: string, required?: bool}>
     */
    public function parameters(): array
    {
        return [
            'sheet_id' => [
                'type' => 'integer',
                'description' => 'The unique identifier of the sheet containing the rows to delete.',
                'required' => true,
            ],
            'row_ids' => [
                'type' => 'array',
                'description' => 'Array of row IDs to delete.',
                'required' => true,
            ],
        ];
    }

    /**
     * Execute the delete rows tool.
     *
     * @param array<string, mixed> $args Tool arguments containing 'sheet_id' and 'row_ids'.
     * @return ToolResult The result confirming deletion or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Smartsheet integration is not configured.');
            }

            $sheetId = $args['sheet_id'] ?? '';
            if (empty($sheetId)) {
                return ToolResult::error('sheet_id is required.');
            }

            $rowIds = $args['row_ids'] ?? [];
            if (empty($rowIds)) {
                return ToolResult::error('row_ids is required and must be a non-empty array.');
            }

            $result = $this->service->deleteRows($sheetId, $rowIds);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
