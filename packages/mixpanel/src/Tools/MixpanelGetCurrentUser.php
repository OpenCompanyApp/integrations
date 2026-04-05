<?php

namespace OpenCompany\Integrations\Mixpanel\Tools;

use OpenCompany\Integrations\Mixpanel\MixpanelService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Verify the authenticated Mixpanel user and retrieve project info.
 *
 * Uses a minimal query request to confirm that the service-account
 * credentials are valid and the API is reachable.
 */
class MixpanelGetCurrentUser implements Tool
{
    /**
     * @param  MixpanelService  $service  The Mixpanel API client
     */
    public function __construct(
        private MixpanelService $service,
    ) {}

    public function name(): string
    {
        return 'mixpanel_get_current_user';
    }

    public function description(): string
    {
        return 'Verify the authenticated user and retrieve basic project info.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Verify authentication and retrieve basic project info.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Mixpanel integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success([
                'authenticated' => true,
                'query_result'  => $result,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
