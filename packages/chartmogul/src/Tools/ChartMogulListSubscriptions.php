<?php

namespace OpenCompany\Integrations\ChartMogul\Tools;

use OpenCompany\Integrations\ChartMogul\ChartMogulService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List subscriptions for a specific ChartMogul customer.
 */
class ChartMogulListSubscriptions implements Tool
{
    /**
     * @param  ChartMogulService  $service  The ChartMogul API client.
     */
    public function __construct(
        private ChartMogulService $service,
    ) {}

    public function name(): string
    {
        return 'chartmogul_list_subscriptions';
    }

    public function description(): string
    {
        return 'List subscriptions for a specific ChartMogul customer. The current API endpoint is /v1/customers/{CUSTOMER_UUID}/subscriptions and uses cursor pagination.';
    }

    public function parameters(): array
    {
        return [
            'per_page' => ['type' => 'integer', 'description' => 'Number of results per page (default: 50, max: 200).'],
            'cursor' => ['type' => 'string', 'description' => 'Cursor from a previous response. Use only when has_more is true.'],
            'customer_uuid' => ['type' => 'string', 'required' => true, 'description' => 'The ChartMogul customer UUID.'],
        ];
    }

    /**
     * List customer subscriptions through the ChartMogul API.
     *
     * @param  array<string, mixed>  $args  Tool arguments (customer_uuid, per_page, cursor).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ChartMogul integration is not configured.');
            }

            if (!isset($args['customer_uuid']) || $args['customer_uuid'] === '') {
                return ToolResult::error('customer_uuid is required.');
            }

            $perPage = isset($args['per_page']) ? (int) $args['per_page'] : 50;
            $customerUuid = (string) $args['customer_uuid'];

            $result = $this->service->listSubscriptions($customerUuid, $perPage, $args['cursor'] ?? null);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
