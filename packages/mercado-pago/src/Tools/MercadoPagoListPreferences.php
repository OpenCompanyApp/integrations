<?php

namespace OpenCompany\Integrations\MercadoPago\Tools;

use OpenCompany\Integrations\MercadoPago\MercadoPagoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Mercado Pago checkout preferences.
 *
 * Supports limit, offset, and sponsor filters.
 */
class MercadoPagoListPreferences implements Tool
{
    /**
     * @param  MercadoPagoService  $service  The Mercado Pago API service.
     */
    public function __construct(
        private MercadoPagoService $service,
    ) {}

    public function name(): string
    {
        return 'mercado_pago_list_preferences';
    }

    public function description(): string
    {
        return 'List checkout preferences from Mercado Pago. Returns a paginated list of checkout preference objects that define items, payer details, and payment settings.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of results to return (default: 30).'],
            'offset' => ['type' => 'integer', 'description' => 'Number of results to skip for pagination (default: 0).'],
            'sponsor_id' => ['type' => 'string', 'description' => 'Filter preferences by the sponsor user ID.'],
        ];
    }

    /**
     * Execute the preference list request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mercado Pago integration is not configured.');
            }

            $params = [];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['offset'])) {
                $params['offset'] = (int) $args['offset'];
            }
            if (isset($args['sponsor_id'])) {
                $params['sponsor_id'] = $args['sponsor_id'];
            }

            $result = $this->service->listPreferences($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
