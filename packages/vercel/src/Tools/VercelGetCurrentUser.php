<?php

namespace OpenCompany\Integrations\Vercel\Tools;

use OpenCompany\Integrations\Core\Contracts\Tool;
use OpenCompany\Integrations\Core\Support\ToolResult;
use OpenCompany\Integrations\Vercel\VercelService;

class VercelGetCurrentUser implements Tool
{
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
