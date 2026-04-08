<?php

namespace OpenCompany\Integrations\Smartsheet\Tools;

use OpenCompany\Integrations\Smartsheet\SmartsheetService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Add a new column to a Smartsheet sheet.
 */
class SmartsheetAddColumn implements Tool
{
    /**
     * Create a new SmartsheetAddColumn tool instance.
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
        return 'smartsheet_add_column';
    }

    /**
     * Get the human-readable tool description.
     *
     * @return string The tool description.
     */
    public function description(): string
    {
        return 'Add a new column to a Smartsheet sheet. Column types include TEXT_NUMBER, DATE, CHECKBOX, PICKLIST, CONTACT_LIST, DATETIME, DURATION, and AUTO_NUMBER.';
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
                'description' => 'The unique identifier of the sheet to add the column to.',
                'required' => true,
            ],
            'title' => [
                'type' => 'string',
                'description' => 'The title for the new column.',
                'required' => true,
            ],
            'type' => [
                'type' => 'string',
                'description' => 'The column type. Supported: TEXT_NUMBER, DATE, CHECKBOX, PICKLIST, CONTACT_LIST, DATETIME, DURATION, ABSTRACT_DATETIME, MULTI_CONTACT_LIST, AUTO_NUMBER.',
                'required' => true,
            ],
            'options' => [
                'type' => 'array',
                'description' => 'Optional additional column options. For PICKLIST columns, include "options" (array of string values) and optionally "option" (e.g., "options": ["Yes","No"]). Other options include "symbol", "width", "format", etc.',
                'required' => false,
            ],
        ];
    }

    /**
     * Execute the add column tool.
     *
     * @param array<string, mixed> $args Tool arguments containing 'sheet_id', 'title', 'type', and optional 'options'.
     * @return ToolResult The result containing the created column data or an error message.
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

            $title = $args['title'] ?? '';
            if (empty($title)) {
                return ToolResult::error('title is required.');
            }

            $type = $args['type'] ?? '';
            if (empty($type)) {
                return ToolResult::error('type is required.');
            }

            $options = $args['options'] ?? null;

            $result = $this->service->addColumn($sheetId, $title, $type, $options);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
