<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

use OpenCompany\Integrations\ConvertKit\ConvertKitService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List subscribers in ConvertKit with pagination and sorting.
 *
 * Returns a paginated list of subscribers from the ConvertKit account.
 * Supports customizable page size, page number, and sort order.
 */
class ConvertKitListSubscribers implements Tool
{
    /**
     * Create a new ConvertKitListSubscribers tool instance.
     */
    public function __construct(
        private ConvertKitService $service,
    ) {}

    /**
     * Return the tool name used for routing.
     */
    public function name(): string
    {
        return 'convertkit_list_subscribers';
    }

    /**
     * Return a human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'List subscribers from your ConvertKit account. Supports pagination and sort order.';
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
            'per_page' => ['type' => 'integer', 'description' => 'Results per page (max 50, default 50).'],
            'sort_order' => ['type' => 'string', 'description' => 'Sort direction: "asc" (oldest first) or "desc" (newest first, default).'],
        ];
    }

    /**
     * Execute the tool: list subscribers from ConvertKit.
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
            $sortOrder = $args['sort_order'] ?? 'desc';

            $result = $this->service->listSubscribers($page, $perPage, $sortOrder);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
