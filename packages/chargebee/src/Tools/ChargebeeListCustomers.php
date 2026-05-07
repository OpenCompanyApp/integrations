<?php

namespace OpenCompany\Integrations\Chargebee\Tools;

use OpenCompany\Integrations\Chargebee\ChargebeeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to list customers from Chargebee with pagination.
 *
 * Returns customer details including email, name, company, and billing address.
 */
class ChargebeeListCustomers implements Tool
{
    /**
     * Create a new ChargebeeListCustomers tool instance.
     *
     * @param  ChargebeeService  $service  The Chargebee API service.
     */
    public function __construct(
        private ChargebeeService $service,
    ) {}

    /**
     * {@inheritdoc}
     */
    public function name(): string
    {
        return 'chargebee_list_customers';
    }

    /**
     * {@inheritdoc}
     */
    public function description(): string
    {
        return 'List customers from Chargebee with pagination. Returns customer details including email, name, company, and billing address.';
    }

    /**
     * {@inheritdoc}
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of customers to return per page (max 100, default 10).'],
            'page' => ['type' => 'string', 'description' => 'Pagination cursor. Pass the value from a previous response to get the next page.'],
        ];
    }

    /**
     * Execute the list customers request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Chargebee integration is not configured.');
            }

            $result = $this->service->listCustomers(
                limit: isset($args['limit']) ? (int) $args['limit'] : null,
                page: $args['page'] ?? null,
            );

            $customers = $result['list'] ?? [];
            $nextOffset = $result['next_offset'] ?? null;

            $items = array_map(function (array $entry): array {
                return $entry['customer'] ?? $entry;
            }, $customers);

            $response = [
                'customers' => $items,
                'count' => count($items),
            ];

            if ($nextOffset !== null) {
                $response['next_page'] = $nextOffset;
            }

            return ToolResult::success($response);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
