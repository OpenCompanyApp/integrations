<?php

namespace OpenCompany\Integrations\Square\Tools;

use OpenCompany\Integrations\Square\SquareService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SquareListCustomers implements Tool
{
    /**
     * Create a new SquareListCustomers tool instance.
     */
    public function __construct(
        private SquareService $service,
    ) {}

    /**
     * Get the tool name.
     */
    public function name(): string
    {
        return 'square_list_customers';
    }

    /**
     * Get the tool description.
     */
    public function description(): string
    {
        return 'List customer profiles from Square. Supports cursor-based pagination.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of customers to return per page (default: 100, max: 100).'],
            'cursor' => ['type' => 'string', 'description' => 'Pagination cursor from a previous response to fetch the next page.'],
        ];
    }

    /**
     * Execute the tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Square integration is not configured.');
            }

            $params = [];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['cursor'])) {
                $params['cursor'] = $args['cursor'];
            }

            $result = $this->service->listCustomers($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
