<?php

namespace OpenCompany\Integrations\Smartsheet\Tools;

use OpenCompany\Integrations\Smartsheet\SmartsheetService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new sheet in Smartsheet with specified name and columns.
 */
class SmartsheetCreateSheet implements Tool
{
    /**
     * Create a new SmartsheetCreateSheet tool instance.
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
        return 'smartsheet_create_sheet';
    }

    /**
     * Get the human-readable tool description.
     *
     * @return string The tool description.
     */
    public function description(): string
    {
        return 'Create a new Smartsheet sheet with a specified name and column definitions.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, description: string, required?: bool}>
     */
    public function parameters(): array
    {
        return [
            'name' => [
                'type' => 'string',
                'description' => 'The name for the new sheet.',
                'required' => true,
            ],
            'columns' => [
                'type' => 'array',
                'description' => 'Array of column definitions. Each column must have "title" and "type". Supported types: TEXT_NUMBER, DATE, CHECKBOX, PICKLIST, CONTACT_LIST, DATETIME, DURATION, MULTI_CONTACT_LIST, AUTO_NUMBER.',
                'required' => true,
            ],
        ];
    }

    /**
     * Execute the create sheet tool.
     *
     * @param array<string, mixed> $args Tool arguments containing 'name' and 'columns'.
     * @return ToolResult The result containing the created sheet data or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Smartsheet integration is not configured.');
            }

            $name = $args['name'] ?? '';
            if (empty($name)) {
                return ToolResult::error('name is required.');
            }

            $columns = $args['columns'] ?? [];
            if (empty($columns)) {
                return ToolResult::error('columns is required and must be a non-empty array.');
            }

            $result = $this->service->createSheet($name, $columns);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
