<?php

namespace OpenCompany\Integrations\Etsy\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Etsy\EtsyService;

/**
 * Get the currently authenticated Etsy user profile.
 */
class EtsyGetCurrentUser implements Tool
{
    /**
     * @param  EtsyService  $service  The Etsy Open API client.
     */
    public function __construct(
        private EtsyService $service,
    ) {}

    public function name(): string
    {
        return 'etsy_get_current_user';
    }

    public function description(): string
    {
        return 'Get the profile of the currently authenticated Etsy user, including user ID and primary shop info.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Fetch the authenticated Etsy user's profile.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Etsy integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
