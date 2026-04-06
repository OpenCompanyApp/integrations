<?php

namespace OpenCompany\Integrations\Braintree\Tools;

use OpenCompany\Integrations\Braintree\BraintreeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class BraintreeGetCurrentUser implements Tool
{
    public function __construct(
        private BraintreeService $service,
    ) {}

    public function name(): string
    {
        return 'braintree_get_current_user';
    }

    public function description(): string
    {
        return 'Get the current Braintree merchant account information. Returns merchant details including business name, currency, and account status.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Braintree integration is not configured. Missing access token or merchant ID.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
