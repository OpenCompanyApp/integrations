<?php

namespace OpenCompany\Integrations\ConvertKit\Tools;

use OpenCompany\Integrations\ConvertKit\ConvertKitService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List subscribers in ConvertKit with pagination and date filtering.
 *
 * Returns a paginated list of subscribers from the ConvertKit account.
 * Supports customizable page size, page number, and date range filters.
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
        return 'List subscribers from your ConvertKit account. Supports pagination and date range filtering.';
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
            'from' => ['type' => 'string', 'description' => 'Filter subscribers added after this date (ISO 8601, e.g. "2025-01-01").'],
            'to' => ['type' => 'string', 'description' => 'Filter subscribers added before this date (ISO 8601, e.g. "2025-12-31").'],
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
            $from = $args['from'] ?? null;
            $to = $args['to'] ?? null;

            $result = $this->service->listSubscribers($page, $perPage, $from, $to);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
