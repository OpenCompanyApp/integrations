<?php

namespace OpenCompany\Integrations\Vercel\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Vercel\VercelService;

/**
 * Retrieve the authenticated Vercel user.
 */
class VercelGetCurrentUser implements Tool
{
    /**
     * @param  VercelService  $service  The Vercel REST API client.
     */
    public function __construct(private VercelService $service)
    {
    }

    public function name(): string
    {
        return 'vercel_get_current_user';
    }

    public function description(): string
    {
        return 'Get the currently authenticated Vercel user profile, including username, email, and plan.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Fetch the current Vercel user.
     *
     * @param  array<string, mixed>  $args  Tool arguments; none are required.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Vercel is not configured. Please set your API token.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error('Failed to get current Vercel user: ' . $e->getMessage());
        }
    }
}
