<?php

namespace OpenCompany\Integrations\Transifex\Tools;

use OpenCompany\Integrations\Transifex\TransifexService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the currently authenticated Transifex user's information.
 */
class TransifexGetCurrentUser implements Tool
{
    public function __construct(
        private TransifexService $service,
    ) {}

    public function name(): string
    {
        return 'transifex_get_current_user';
    }

    public function description(): string
    {
        return 'Get information about the currently authenticated Transifex user, including username, email, and account details.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Transifex integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
