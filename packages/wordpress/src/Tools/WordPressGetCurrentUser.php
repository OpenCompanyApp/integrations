<?php

namespace OpenCompany\Integrations\WordPress\Tools;

use OpenCompany\Integrations\WordPress\WordPressService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get the currently authenticated WordPress user via the REST API.
 *
 * Calls GET /wp/v2/users/me and returns the full user profile.
 */
class WordPressGetCurrentUser implements Tool
{
    /**
     * Create a new WordPressGetCurrentUser tool instance.
     *
     * @param WordPressService $service The WordPress REST API service.
     */
    public function __construct(
        private WordPressService $service,
    ) {}

    /**
     * Get the tool identifier.
     *
     * @return string The tool name used for registration and dispatch.
     */
    public function name(): string
    {
        return 'wordpress_get_current_user';
    }

    /**
     * Get the human-readable description of what this tool does.
     *
     * @return string A description for AI agents and UI display.
     */
    public function description(): string
    {
        return 'Get the currently authenticated WordPress user profile. Returns user ID, name, email, roles, and capabilities.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array{type: string, description: string, required?: bool}> Parameter definitions (none for this tool).
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool — get the current user from WordPress.
     *
     * @param array $args Tool parameters (none required).
     * @return ToolResult The result containing the current user data or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('WordPress integration is not configured. Provide username and application password.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
