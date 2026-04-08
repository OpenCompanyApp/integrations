<?php

namespace OpenCompany\Integrations\AssemblyAI\Tools;

use OpenCompany\Integrations\AssemblyAI\AssemblyAIService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the currently authenticated user's profile information.
 *
 * Sends a GET request to /users/me and returns the user's profile
 * including email, subscription plan, and usage details.
 *
 * @see https://www.assemblyai.com/docs/assemblyai-api
 */
class AssemblyAIGetCurrentUser implements Tool
{
    /**
     * @param  AssemblyAIService  $service  The AssemblyAI service instance.
     */
    public function __construct(
        private AssemblyAIService $service,
    ) {}

    /**
     * The tool identifier.
     */
    public function name(): string
    {
        return 'assemblyai_get_current_user';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get the authenticated user\'s profile, including email, subscription plan, and API usage details.';
    }

    /**
     * This tool takes no parameters.
     *
     * @return array<string, mixed>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the get current user request.
     *
     * @param  array  $args  No parameters required.
     * @return ToolResult The user profile data or an error.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('AssemblyAI integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
