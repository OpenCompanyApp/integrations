<?php

namespace OpenCompany\Integrations\Pushover\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Pushover\PushoverService;

/**
 * Retrieve the Pushover application token's monthly message quota.
 */
class PushoverGetApplicationLimits implements Tool
{
    /**
     * @param  PushoverService  $service  The Pushover API client.
     */
    public function __construct(
        private PushoverService $service,
    ) {}

    public function name(): string
    {
        return 'pushover_get_application_limits';
    }

    public function description(): string
    {
        return 'Get the monthly message limit, remaining messages, reset timestamp, and application status for the Pushover app token.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Get the app token's monthly message quota.
     *
     * @param  array<string, mixed>  $args  Tool arguments; none are required.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Pushover integration is not configured.');
            }

            return ToolResult::success($this->service->getApplicationLimits());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
