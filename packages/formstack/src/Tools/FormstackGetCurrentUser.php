<?php

namespace OpenCompany\Integrations\Formstack\Tools;

use OpenCompany\Integrations\Formstack\FormstackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * FormstackGetCurrentUser — Get the currently authenticated Formstack user's profile.
 *
 * Returns user details including name, email, and account information.
 * Useful for verifying the connected account identity.
 *
 * @see https://www.formstack.com/docs/api/v2/user#get-the-current-user
 */
class FormstackGetCurrentUser implements Tool
{
    /**
     * @param  FormstackService  $service  The Formstack API service instance.
     */
    public function __construct(
        private FormstackService $service,
    ) {}

    /**
     * Machine name of the tool.
     */
    public function name(): string
    {
        return 'formstack_get_current_user';
    }

    /**
     * Human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'Get the currently authenticated Formstack user profile. Returns name, email, and account info.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, mixed>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool — get current user from Formstack.
     *
     * @param  array<string, mixed>  $args  Tool arguments (unused).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Formstack integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
