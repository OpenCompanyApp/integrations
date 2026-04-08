<?php

namespace OpenCompany\Integrations\Ifttt\Tools;

use OpenCompany\Integrations\Ifttt\IftttService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the currently authenticated IFTTT user.
 */
class IftttGetCurrentUser implements Tool
{
    /**
     * @param  IftttService  $service  The IFTTT API client
     */
    public function __construct(
        private IftttService $service,
    ) {}

    public function name(): string
    {
        return 'ifttt_get_current_user';
    }

    public function description(): string
    {
        return 'Get the currently authenticated IFTTT user.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Retrieve the currently authenticated user's profile.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('IFTTT integration is not configured.');
            }

            $user = $this->service->getCurrentUser();

            return ToolResult::success($user);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
