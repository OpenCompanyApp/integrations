<?php

namespace OpenCompany\Integrations\Smartsheet\Tools;

use OpenCompany\Integrations\Smartsheet\SmartsheetService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update one or more existing rows in a Smartsheet sheet.
 */
class SmartsheetUpdateRows implements Tool
{
    /**
     * Create a new SmartsheetUpdateRows tool instance.
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
        return 'smartsheet_update_rows';
    }

    /**
     * Get the human-readable tool description.
     *
     * @return string The tool description.
     */
    public function description(): string
    {
        return 'Update one or more existing rows in a Smartsheet sheet. Each row must include its "id" field along with updated cell values.';
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
                'description' => 'The unique identifier of the sheet containing the rows to update.',
                'required' => true,
            ],
            'rows' => [
                'type' => 'array',
                'description' => 'Array of row objects to update. Each row must have "id" and a "cells" array with {"columnId": int, "value": mixed}.',
                'required' => true,
            ],
        ];
    }

    /**
     * Execute the update rows tool.
     *
     * @param array<string, mixed> $args Tool arguments containing 'sheet_id' and 'rows'.
     * @return ToolResult The result containing the updated row data or an error message.
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

            $rows = $args['rows'] ?? [];
            if (empty($rows)) {
                return ToolResult::error('rows is required and must be a non-empty array.');
            }

            $result = $this->service->updateRows($sheetId, $rows);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
