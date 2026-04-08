<?php

namespace OpenCompany\Integrations\Jenkins\Tools;

use OpenCompany\Integrations\Jenkins\JenkinsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the authenticated Jenkins user's profile information.
 */
class JenkinsGetCurrentUser implements Tool
{
    /** @param  JenkinsService  $service  The Jenkins API client */
    public function __construct(
        private JenkinsService $service,
    ) {}

    public function name(): string
    {
        return 'jenkins_get_current_user';
    }

    public function description(): string
    {
        return 'Get the authenticated Jenkins user\'s profile information, including user ID, full name, and email.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Retrieve the authenticated user's profile.
     *
     * @param  array<string, mixed>  $args  Tool arguments (unused)
     */
    public function execute(array $args): ToolResult
    {
        if (! $this->service->isConfigured()) {
            return ToolResult::error('Jenkins is not configured. Missing API token.');
        }

        try {
            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
