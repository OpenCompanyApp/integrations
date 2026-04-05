<?php

namespace OpenCompany\Integrations\Smartsheet\Tools;

use OpenCompany\Integrations\Smartsheet\SmartsheetService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all sheets accessible to the authenticated Smartsheet user.
 */
class SmartsheetListSheets implements Tool
{
    /**
     * Create a new SmartsheetListSheets tool instance.
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
        return 'smartsheet_list_sheets';
    }

    /**
     * Get the human-readable tool description.
     *
     * @return string The tool description.
     */
    public function description(): string
    {
        return 'List all sheets accessible to the authenticated Smartsheet user. Returns sheet names and IDs.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, description: string, required?: bool}>
     */
    public function parameters(): array
    {
        return [
            'limit' => [
                'type' => 'integer',
                'description' => 'Maximum number of sheets to return (default 100, max 100).',
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
     * Execute the list sheets tool.
     *
     * @param array<string, mixed> $args Tool arguments containing optional 'limit' and 'page'.
     * @return ToolResult The result containing the list of sheets or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Smartsheet integration is not configured.');
            }

            $limit = (int) ($args['limit'] ?? 100);
            $page = (int) ($args['page'] ?? 1);

            $result = $this->service->listSheets($limit, $page);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
