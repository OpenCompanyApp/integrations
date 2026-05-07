<?php

namespace OpenCompany\Integrations\MercadoPago\Tools;

use OpenCompany\Integrations\MercadoPago\MercadoPagoService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Fetch the authenticated Mercado Pago user profile.
 *
 * Uses the user identity endpoint as a lightweight credential check.
 */
class MercadoPagoGetCurrentUser implements Tool
{
    /**
     * @param  MercadoPagoService  $service  The Mercado Pago API service.
     */
    public function __construct(
        private MercadoPagoService $service,
    ) {}

    public function name(): string
    {
        return 'mercado_pago_get_current_user';
    }

    public function description(): string
    {
        return 'Get the authenticated Mercado Pago user\'s account information, including name, email, and user ID.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the current-user request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mercado Pago integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
