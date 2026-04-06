<?php

namespace OpenCompany\Integrations\Adyen\Tools;

use OpenCompany\Integrations\Adyen\AdyenService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get current merchant account information from Adyen.
 *
 * Acts as a health check by calling the paymentMethods endpoint with the
 * configured merchant account, returning available payment methods and
 * confirming the API connection is working.
 */
class AdyenGetCurrentMerchant implements Tool
{
    /**
     * Create a new AdyenGetCurrentMerchant tool instance.
     */
    public function __construct(
        private AdyenService $service,
    ) {}

    /**
     * {@inheritDoc}
     */
    public function name(): string
    {
        return 'adyen_get_current_merchant';
    }

    /**
     * {@inheritDoc}
     */
    public function description(): string
    {
        return 'Get current merchant account information from Adyen. Verifies API connectivity and returns available payment methods for the merchant account.';
    }

    /**
     * {@inheritDoc}
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * {@inheritDoc}
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Adyen integration is not configured.');
            }

            $result = $this->service->getCurrentMerchant();

            return ToolResult::success([
                'merchantAccount' => $this->service->getMerchantAccount(),
                'connection' => 'ok',
                'data' => $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
