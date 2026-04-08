<?php

namespace OpenCompany\Integrations\Modal\Tools;

use OpenCompany\Integrations\Modal\ModalService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the current authenticated Modal user information.
 */
class ModalGetCurrentUser implements Tool
{
    public function __construct(
        private ModalService $service,
    ) {}

    public function name(): string
    {
        return 'modal_get_current_user';
    }

    public function description(): string
    {
        return 'Get the current authenticated Modal user information, including name, email, and account details.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Modal integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
