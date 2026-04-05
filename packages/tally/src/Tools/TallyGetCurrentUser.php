<?php

namespace OpenCompany\Integrations\Tally\Tools;

use OpenCompany\Integrations\Tally\TallyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get profile information for the currently authenticated Tally user.
 *
 * Returns the user's name, email, and account details.
 */
class TallyGetCurrentUser implements Tool
{
    public function __construct(
        private TallyService $service,
    ) {}

    /**
     * Unique tool identifier.
     */
    public function name(): string
    {
        return 'tally_get_current_user';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get profile information for the currently authenticated Tally user. Returns name, email, and account details. Useful for verifying the connection and identifying which account is in use.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array<string, string>>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the get_current_user tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (unused).
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
