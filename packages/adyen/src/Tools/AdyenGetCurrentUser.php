<?php

namespace OpenCompany\Integrations\Adyen\Tools;

use OpenCompany\Integrations\Adyen\AdyenService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to verify Adyen API connectivity and retrieve merchant info.
 *
 * Acts as a health check by calling the payment methods endpoint
 * to confirm the API key and merchant account are valid.
 */
class AdyenGetCurrentUser implements Tool
{
    /**
     * Create a new AdyenGetCurrentUser tool instance.
     *
     * @param  \OpenCompany\Integrations\Adyen\AdyenService  $service
     */
    public function __construct(
        private AdyenService $service,
    ) {}

    /**
     * {@inheritDoc}
     */
    public function name(): string
    {
        return 'adyen_get_current_user';
    }

    /**
     * {@inheritDoc}
     */
    public function description(): string
    {
        return 'Verify Adyen API connectivity and retrieve current merchant account information. Useful as a health check to confirm the integration is properly configured.';
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
                'connected' => true,
                'merchant_account' => $this->service->getMerchantAccount(),
                'payment_methods' => $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
