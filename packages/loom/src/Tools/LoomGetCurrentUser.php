<?php

namespace OpenCompany\Integrations\Loom\Tools;

use OpenCompany\Integrations\Loom\LoomService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the currently authenticated user's profile information.
 *
 * Returns the user's name, email, avatar URL, account type,
 * and other profile details from Loom.
 *
 * @see https://developer.loom.com/docs/api-reference
 */
class LoomGetCurrentUser implements Tool
{
    public function __construct(
        private LoomService $service,
    ) {}

    /**
     * Get the tool identifier.
     */
    public function name(): string
    {
        return 'loom_get_current_user';
    }

    /**
     * Get the human-readable tool description.
     */
    public function description(): string
    {
        return 'Get the authenticated Loom user\'s profile information, including name, email, and account details.';
    }

    /**
     * Get the tool parameter definitions.
     *
     * @return array<string, mixed>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the get current user API call.
     *
     * @param  array<string, mixed>  $args  No parameters required.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Loom integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
