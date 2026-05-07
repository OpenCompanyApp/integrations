<?php

namespace OpenCompany\Integrations\Mollie\Tools;

use OpenCompany\Integrations\Mollie\MollieService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List customers from Mollie.
 *
 * Returns the list of customer resources with optional pagination.
 */
class MollieListCustomers implements Tool
{
    /**
     * @param  MollieService  $service  The Mollie API client.
     */
    public function __construct(
        private MollieService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'mollie_list_customers';
    }

    /**
     * Get the tool description for AI agents.
     */
    public function description(): string
    {
        return 'List all customers from Mollie. Returns customer resources with name, email, and metadata.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of customers to return (default: 50, max: 250).'],
            'from' => ['type' => 'string', 'description' => 'Customer ID to start from for pagination.'],
        ];
    }

    /**
     * Execute the list customers tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mollie integration is not configured.');
            }

            $params = [];
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['from'])) {
                $params['from'] = $args['from'];
            }

            $result = $this->service->listCustomers($params);

            $customers = $result['_embedded']['customers'] ?? [];
            $count = count($customers);

            return ToolResult::success([
                'customers' => $customers,
                'count' => $count,
                '_links' => $result['_links'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
