<?php

namespace OpenCompany\Integrations\Wealthbox\Tools;

use OpenCompany\Integrations\Wealthbox\WealthboxService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class WealthboxListOpportunities implements Tool
{
    /**
     * Create a new WealthboxListOpportunities tool instance.
     */
    public function __construct(
        private WealthboxService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'wealthbox_list_opportunities';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'List opportunities (sales pipeline) from Wealthbox CRM. Returns a paginated list of opportunities with details like name, value, stage, and associated contact.';
    }

    /**
     * Get the tool parameters schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of opportunities per page (default: 25, max: 200).'],
            'status' => ['type' => 'string', 'description' => 'Filter by opportunity status (e.g., "open", "won", "lost").'],
        ];
    }

    /**
     * Execute the list opportunities tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Wealthbox integration is not configured.');
            }

            $params = [];
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }
            if (isset($args['per_page'])) {
                $params['per_page'] = (int) $args['per_page'];
            }
            if (isset($args['status'])) {
                $params['status'] = $args['status'];
            }

            $result = $this->service->listOpportunities($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
