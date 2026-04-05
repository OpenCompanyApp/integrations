<?php

namespace OpenCompany\Integrations\Bitly\Tools;

use OpenCompany\Integrations\Bitly\BitlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List all groups in the Bitly account.
 *
 * Calls GET /groups to retrieve all groups the authenticated user
 * has access to, including their GUIDs, names, and organizational info.
 */
class BitlyListGroups implements Tool
{
    /**
     * Create a new BitlyListGroups tool instance.
     *
     * @param BitlyService $service The Bitly API service
     */
    public function __construct(
        private BitlyService $service,
    ) {}

    /**
     * Get the tool name.
     *
     * @return string The tool identifier
     */
    public function name(): string
    {
        return 'bitly_list_groups';
    }

    /**
     * Get the tool description.
     *
     * @return string A human-readable description of what the tool does
     */
    public function description(): string
    {
        return 'List all groups in the Bitly account. Groups organize links and are used when creating new Bitlinks.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array Parameter definitions keyed by parameter name
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool: list all groups.
     *
     * @param array $args Tool arguments (none required)
     *
     * @return ToolResult The groups data or an error message
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Bitly integration is not configured.');
            }

            $result = $this->service->listGroups();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
