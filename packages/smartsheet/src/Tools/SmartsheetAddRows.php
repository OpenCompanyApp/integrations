<?php

namespace OpenCompany\Integrations\Smartsheet\Tools;

use OpenCompany\Integrations\Smartsheet\SmartsheetService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Add one or more rows to a Smartsheet sheet.
 */
class SmartsheetAddRows implements Tool
{
    /**
     * Create a new SmartsheetAddRows tool instance.
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
        return 'smartsheet_add_rows';
    }

    /**
     * Get the human-readable tool description.
     *
     * @return string The tool description.
     */
    public function description(): string
    {
        return 'Add one or more rows to a Smartsheet sheet. Each row should have a "cells" array with objects containing "columnId" and "value".';
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
                'description' => 'The unique identifier of the sheet to add rows to.',
                'required' => true,
            ],
            'rows' => [
                'type' => 'array',
                'description' => 'Array of row objects. Each row must have a "cells" array with {"columnId": int, "value": mixed}. Optionally include "toTop": true or "toBottom": true.',
                'required' => true,
            ],
        ];
    }

    /**
     * Execute the add rows tool.
     *
     * @param array<string, mixed> $args Tool arguments containing 'sheet_id' and 'rows'.
     * @return ToolResult The result containing the added row data or an error message.
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

            $result = $this->service->addRows($sheetId, $rows);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
