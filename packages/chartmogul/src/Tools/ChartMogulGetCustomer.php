<?php

namespace OpenCompany\Integrations\ChartMogul\Tools;

use OpenCompany\Integrations\ChartMogul\ChartMogulService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Fetch a single ChartMogul customer by UUID.
 */
class ChartMogulGetCustomer implements Tool
{
    /**
     * @param  ChartMogulService  $service  The ChartMogul API client.
     */
    public function __construct(
        private ChartMogulService $service,
    ) {}

    public function name(): string
    {
        return 'chartmogul_get_customer';
    }

    public function description(): string
    {
        return 'Get details for a single ChartMogul customer by UUID. Returns full customer information including attributes, address, and custom fields.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The ChartMogul customer UUID.'],
        ];
    }

    /**
     * Get a customer by UUID through the ChartMogul API.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('ChartMogul integration is not configured.');
            }

            if (!isset($args['id']) || $args['id'] === '') {
                return ToolResult::error('Customer UUID is required.');
            }

            $result = $this->service->getCustomer($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
