<?php

namespace OpenCompany\Integrations\BuyMeACoffee\Tools;

use OpenCompany\Integrations\BuyMeACoffee\BuyMeACoffeeService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class BuyMeACoffeeGetCurrentUser implements Tool
{
    public function __construct(
        private BuyMeACoffeeService $service,
    ) {}

    public function name(): string
    {
        return 'buymeacoffee_get_current_user';
    }

    public function description(): string
    {
        return 'Get the profile of the currently authenticated Buy Me a Coffee user. Useful to verify the connection and see account details.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Buy Me a Coffee integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            $user = $result['data'] ?? $result['user'] ?? $result;

            return ToolResult::success($user);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
