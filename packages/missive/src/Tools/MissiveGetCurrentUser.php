<?php

namespace OpenCompany\Integrations\Missive\Tools;

use OpenCompany\Integrations\Missive\MissiveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: missive_get_current_user
 *
 * Retrieve the profile of the currently authenticated Missive user.
 */
class MissiveGetCurrentUser implements Tool
{
    /**
     * @param  MissiveService  $service  The Missive API service instance.
     */
    public function __construct(
        private MissiveService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'missive_get_current_user';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get the profile of the currently authenticated Missive user, including name, email, and organization info.';
    }

    /**
     * Define the accepted parameters.
     *
     * @return array<string, mixed>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool — get the current user profile from Missive.
     *
     * @param  array<string, mixed>  $args  The input parameters (unused).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Missive integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
