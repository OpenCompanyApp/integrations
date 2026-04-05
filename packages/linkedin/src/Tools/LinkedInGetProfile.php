<?php

namespace OpenCompany\Integrations\LinkedIn\Tools;

use OpenCompany\Integrations\LinkedIn\LinkedInService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to retrieve the authenticated user's LinkedIn profile.
 *
 * Returns profile information including the user's LinkedIn ID,
 * first name, last name, and other available profile fields.
 */
class LinkedInGetProfile implements Tool
{
    /**
     * Create a new LinkedInGetProfile tool instance.
     *
     * @param  LinkedInService  $service  The LinkedIn API service.
     */
    public function __construct(
        private LinkedInService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'linkedin_get_profile';
    }

    /**
     * Get the tool description for AI agent consumption.
     */
    public function description(): string
    {
        return "Get the authenticated user's full LinkedIn profile. Returns profile ID, name, and other available fields from the /me endpoint.";
    }

    /**
     * Get the tool parameter schema.
     *
     * @return array<string, array{type: string, description?: string}>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool and return the LinkedIn profile data.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none required).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('LinkedIn integration is not configured.');
            }

            $result = $this->service->getProfile();

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
