<?php

namespace OpenCompany\Integrations\Paystack\Tools;

use OpenCompany\Integrations\Paystack\PaystackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Verify Paystack connectivity for the configured secret key.
 *
 * Calls a lightweight integration endpoint to check that the API is reachable.
 */
class PaystackGetCurrentUser implements Tool
{
    /**
     * @param  PaystackService  $service  The Paystack API service.
     */
    public function __construct(
        private PaystackService $service,
    ) {}

    public function name(): string
    {
        return 'paystack_get_current_user';
    }

    public function description(): string
    {
        return 'Verify the Paystack API connection and retrieve integration payment session timeout settings. Use this to check if the API key is valid and the service is reachable.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the Paystack connection check.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Paystack integration is not configured.');
            }

            $result = $this->service->getHealth();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
