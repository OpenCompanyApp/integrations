<?php

namespace OpenCompany\Integrations\Smartsheet\Tools;

use OpenCompany\Integrations\Smartsheet\SmartsheetService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a specific Smartsheet sheet by ID, including its rows and columns.
 */
class SmartsheetGetSheet implements Tool
{
    /**
     * Create a new SmartsheetGetSheet tool instance.
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
        return 'smartsheet_get_sheet';
    }

    /**
     * Get the human-readable tool description.
     *
     * @return string The tool description.
     */
    public function description(): string
    {
        return 'Get a specific Smartsheet sheet by ID, including its rows and columns.';
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
                'description' => 'The unique identifier of the sheet to retrieve.',
                'required' => true,
            ],
            'level' => [
                'type' => 'integer',
                'description' => 'The nesting level for the response (0–2). Default is 0.',
                'required' => false,
            ],
            'page_size' => [
                'type' => 'integer',
                'description' => 'Number of rows per page. Default is 100.',
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
     * Execute the get sheet tool.
     *
     * @param array<string, mixed> $args Tool arguments containing 'sheet_id' and optional pagination params.
     * @return ToolResult The result containing the sheet data or an error message.
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

            $level = (int) ($args['level'] ?? 0);
            $pageSize = (int) ($args['page_size'] ?? 100);
            $page = (int) ($args['page'] ?? 1);

            $result = $this->service->getSheet($sheetId, $level, $pageSize, $page);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
