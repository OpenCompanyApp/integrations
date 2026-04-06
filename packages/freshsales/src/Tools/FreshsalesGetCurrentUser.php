<?php

namespace OpenCompany\Integrations\Freshsales\Tools;

use OpenCompany\Integrations\Freshsales\FreshsalesService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the currently authenticated Freshsales user.
 *
 * Returns profile information for the user whose API key is configured.
 * Useful for verifying the connection and understanding whose context
 * the API calls are made in.
 */
class FreshsalesGetCurrentUser implements Tool
{
    public function __construct(
        private FreshsalesService $service,
    ) {}

    public function name(): string
    {
        return 'freshsales_get_current_user';
    }

    public function description(): string
    {
        return 'Get the profile of the currently authenticated Freshsales user. Useful for verifying the API connection.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Freshsales integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
