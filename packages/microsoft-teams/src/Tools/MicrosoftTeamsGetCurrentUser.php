<?php

namespace OpenCompany\Integrations\MicrosoftTeams\Tools;

use OpenCompany\Integrations\MicrosoftTeams\MicrosoftTeamsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool to get the profile of the currently authenticated Microsoft Teams user.
 *
 * Calls GET /me on the Microsoft Graph API and returns user profile information
 * including displayName, mail, and jobTitle.
 */
class MicrosoftTeamsGetCurrentUser implements Tool
{
    /**
     * Create a new MicrosoftTeamsGetCurrentUser tool instance.
     */
    public function __construct(
        private MicrosoftTeamsService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'microsoft_teams_get_current_user';
    }

    /**
     * Get a human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get the profile of the currently authenticated Microsoft Teams user. Returns display name, email, and job title.';
    }

    /**
     * Get the parameter schema for this tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool and return the current user profile.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none required).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Microsoft Teams integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success([
                'id' => $result['id'] ?? null,
                'displayName' => $result['displayName'] ?? null,
                'mail' => $result['mail'] ?? null,
                'userPrincipalName' => $result['userPrincipalName'] ?? null,
                'jobTitle' => $result['jobTitle'] ?? null,
                'officeLocation' => $result['officeLocation'] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
