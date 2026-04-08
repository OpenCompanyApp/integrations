<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

use OpenCompany\Integrations\ConvertKit\ConvertKitService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List broadcasts in ConvertKit with pagination.
 *
 * Returns a paginated list of broadcasts (email blasts) from the
 * ConvertKit account, including their subject lines, status, and metadata.
 */
class ConvertKitListBroadcasts implements Tool
{
    /**
     * Create a new ConvertKitListBroadcasts tool instance.
     */
    public function __construct(
        private ConvertKitService $service,
    ) {}

    /**
     * Return the tool name used for routing.
     */
    public function name(): string
    {
        return 'convertkit_list_broadcasts';
    }

    /**
     * Return a human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List broadcasts (email blasts) from your ConvertKit account. Supports pagination.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array<string, mixed>> Parameter definitions
     */
    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number (starts at 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Results per page (default 50).'],
        ];
    }

    /**
     * Execute the tool: list broadcasts from ConvertKit.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ConvertKit integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $perPage = isset($args['per_page']) ? (int) $args['per_page'] : 50;

            $result = $this->service->listBroadcasts($page, $perPage);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
