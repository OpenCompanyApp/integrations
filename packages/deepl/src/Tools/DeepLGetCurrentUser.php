<?php

namespace OpenCompany\Integrations\DeepL\Tools;

use OpenCompany\Integrations\DeepL\DeepLService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get current user / account information from the DeepL API.
 *
 * Returns account-level details derived from the usage endpoint.
 */
class DeepLGetCurrentUser implements Tool
{
    public function __construct(
        private DeepLService $service,
    ) {}

    public function name(): string
    {
        return 'deepl_get_current_user';
    }

    public function description(): string
    {
        return 'Get current DeepL account information. Returns usage statistics and account details.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('DeepL integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
