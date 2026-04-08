<?php

namespace OpenCompany\Integrations\Mollie\Tools;

use OpenCompany\Integrations\Mollie\MollieService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List subscriptions for a specific Mollie customer.
 *
 * Requires a customer ID. Returns the list of subscription resources
 * for that customer with optional pagination.
 */
class MollieListSubscriptions implements Tool
{
    /**
     * Create a new MollieListSubscriptions tool instance.
     */
    public function __construct(
        private MollieService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'mollie_list_subscriptions';
    }

    /**
     * Get the tool description for AI agents.
     */
    public function description(): string
    {
        return 'List all subscriptions for a specific Mollie customer. Requires a customer ID (e.g., "cst_abc123"). Returns subscription resources with status, amount, and interval.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'customer_id' => ['type' => 'string', 'required' => true, 'description' => 'The customer ID (e.g., "cst_abc123").'],
            'limit' => ['type' => 'integer', 'description' => 'Number of subscriptions to return (default: 50, max: 250).'],
            'from' => ['type' => 'string', 'description' => 'Subscription ID to start from for pagination.'],
        ];
    }

    /**
     * Execute the list subscriptions tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mollie integration is not configured.');
            }

            if (empty($args['customer_id'])) {
                return ToolResult::error('Customer ID is required.');
            }

            $params = [];
            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['from'])) {
                $params['from'] = $args['from'];
            }

            $result = $this->service->listSubscriptions($args['customer_id'], $params);

            $subscriptions = $result['_embedded']['subscriptions'] ?? [];
            $count = count($subscriptions);

            return ToolResult::success([
                'subscriptions' => $subscriptions,
                'count' => $count,
                '_links' => $result['_links'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
