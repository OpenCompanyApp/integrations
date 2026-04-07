<?php

namespace OpenCompany\Integrations\Trello\Tools;

use OpenCompany\Integrations\Trello\TrelloService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the currently authenticated Trello user.
 *
 * Returns information about the authenticated user, useful for verifying
 * credentials and displaying account details.
 */
class TrelloGetCurrentUser implements Tool
{
    public function __construct(
        private TrelloService $service,
    ) {}

    public function name(): string
    {
        return 'trello_get_current_user';
    }

    public function description(): string
    {
        return 'Get the profile of the currently authenticated Trello user. Useful for verifying credentials and displaying account information.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Trello integration is not configured.');
            }

            $user = $this->service->getCurrentUser();

            return ToolResult::success($user);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
