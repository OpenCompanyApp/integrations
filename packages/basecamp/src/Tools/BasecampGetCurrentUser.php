<?php

namespace OpenCompany\Integrations\Basecamp\Tools;

use OpenCompany\Integrations\Basecamp\BasecampService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: basecamp_get_current_user
 *
 * Retrieves the profile of the currently authenticated Basecamp user.
 *
 * @see https://github.com/basecamp/api/blob/master/sections/people.md#get-current-user
 */
class BasecampGetCurrentUser implements Tool
{
    /**
     * @param  BasecampService  $service  The Basecamp API service instance.
     */
    public function __construct(
        private BasecampService $service,
    ) {}

    /**
     * Machine name of the tool.
     */
    public function name(): string
    {
        return 'basecamp_get_current_user';
    }

    /**
     * Human-readable description shown to AI agents.
     */
    public function description(): string
    {
        return 'Get the profile of the currently authenticated Basecamp user. Returns name, email, avatar, and account details.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool — fetch the current user from Basecamp.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none required).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Basecamp integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
