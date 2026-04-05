<?php

namespace OpenCompany\Integrations\Calendly\Tools;

use OpenCompany\Integrations\Calendly\CalendlyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the authenticated Calendly user's profile.
 *
 * Retrieves the current user's name, email, scheduling URL,
 * timezone, and organization membership.
 */
class CalendlyGetUser implements Tool
{
    /**
     * @param  CalendlyService  $service  The Calendly API client
     */
    public function __construct(
        private CalendlyService $service,
    ) {}

    public function name(): string
    {
        return 'calendly_get_user';
    }

    public function description(): string
    {
        return 'Get the authenticated Calendly user profile.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Fetch the authenticated user's profile.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none required)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Calendly integration is not configured.');
            }

            $result = $this->service->getUser();

            return ToolResult::success([
                'resource' => $result['resource'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
