<?php

namespace OpenCompany\Integrations\Tally\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Tally\TallyService;

/**
 * Get the currently authenticated Tally user's profile information.
 */
class TallyGetCurrentUser implements Tool
{
    /**
     * @param  TallyService  $service  The Tally API service instance.
     */
    public function __construct(
        private TallyService $service,
    ) {}

    public function name(): string
    {
        return 'tally_get_current_user';
    }

    public function description(): string
    {
        return 'Get the authenticated user\'s profile information, including name, email, and account details.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the get current user request.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none required).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Tally integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
