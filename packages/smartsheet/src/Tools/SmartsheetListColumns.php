<?php

namespace OpenCompany\Integrations\Smartsheet\Tools;

use OpenCompany\Integrations\Smartsheet\SmartsheetService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all columns in a Smartsheet sheet.
 */
class SmartsheetListColumns implements Tool
{
    /**
     * Create a new SmartsheetListColumns tool instance.
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
        return 'smartsheet_list_columns';
    }

    /**
     * Get the human-readable tool description.
     *
     * @return string The tool description.
     */
    public function description(): string
    {
        return 'List all columns in a Smartsheet sheet, including their titles, types, and IDs.';
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
                'description' => 'The unique identifier of the sheet.',
                'required' => true,
            ],
            'limit' => [
                'type' => 'integer',
                'description' => 'Maximum number of columns to return (default 100).',
                'required' => false,
            ],
            'page' => [
                'type' => 'integer',
                'description' => 'Page number for pagination (1-based).',
                'required' => false,
            ],
        ];
    }

    /**
     * Execute the list columns tool.
     *
     * @param array<string, mixed> $args Tool arguments containing 'sheet_id' and optional pagination params.
     * @return ToolResult The result containing the list of columns or an error message.
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

            $limit = (int) ($args['limit'] ?? 100);
            $page = (int) ($args['page'] ?? 1);

            $result = $this->service->listColumns($sheetId, $limit, $page);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
