<?php

namespace OpenCompany\Integrations\Pushover\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Pushover\PushoverService;

/**
 * Retrieve remaining Pushover license credits for the application token.
 */
class PushoverGetLicenseCredits implements Tool
{
    /**
     * @param  PushoverService  $service  The Pushover API client.
     */
    public function __construct(
        private PushoverService $service,
    ) {}

    public function name(): string
    {
        return 'pushover_get_license_credits';
    }

    public function description(): string
    {
        return 'Get the number of prepaid Pushover license credits available for assignment.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Get remaining license credits.
     *
     * @param  array<string, mixed>  $args  Tool arguments; none are required.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Pushover integration is not configured.');
            }

            return ToolResult::success($this->service->getLicenseCredits());
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
