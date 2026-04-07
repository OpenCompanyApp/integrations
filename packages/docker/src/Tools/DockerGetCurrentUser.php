<?php

namespace OpenCompany\Integrations\Docker\Tools;

use OpenCompany\Integrations\Docker\DockerService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the currently authenticated Docker Hub user profile.
 *
 * Returns information about the authenticated user, useful for verifying
 * credentials and displaying account details.
 */
class DockerGetCurrentUser implements Tool
{
    public function __construct(
        private DockerService $service,
    ) {}

    public function name(): string
    {
        return 'docker_get_current_user';
    }

    public function description(): string
    {
        return 'Get the profile of the currently authenticated Docker Hub user. Useful for verifying credentials and displaying account information.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Docker Hub integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
