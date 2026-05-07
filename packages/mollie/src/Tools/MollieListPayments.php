<?php

namespace OpenCompany\Integrations\Mollie\Tools;

use OpenCompany\Integrations\Mollie\MollieService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List payments from Mollie with optional filters.
 *
 * Supports pagination via limit and from parameters. Returns the Mollie
 * payments list embedded in the API response.
 */
class MollieListPayments implements Tool
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
        return 'mollie_list_payments';
    }

    /**
     * Get the tool description for AI agents.
     */
    public function description(): string
    {
        return 'List payments from Mollie. Returns payment resources with status, amount, and metadata. Use filters like profileId to narrow results.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, array{type: string, required?: bool, description: string}>
     */
    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Number of payments to return (default: 50, max: 250).'],
            'from' => ['type' => 'string', 'description' => 'Payment ID to start from for pagination.'],
            'profileId' => ['type' => 'string', 'description' => 'Filter by profile ID.'],
        ];
    }

    /**
     * Execute the list payments tool.
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
            if (isset($args['profileId'])) {
                $params['profileId'] = $args['profileId'];
            }

            $result = $this->service->listPayments($params);

            $payments = $result['_embedded']['payments'] ?? [];
            $count = count($payments);

            return ToolResult::success([
                'payments' => $payments,
                'count' => $count,
                '_links' => $result['_links'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
