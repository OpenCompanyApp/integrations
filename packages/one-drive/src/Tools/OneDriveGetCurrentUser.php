<?php

namespace OpenCompany\Integrations\OneDrive\Tools;

use OpenCompany\Integrations\OneDrive\OneDriveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get the profile of the currently authenticated Microsoft user.
 *
 * Returns the user's display name, email, and other profile information
 * from the Microsoft Graph API.
 */
class OneDriveGetCurrentUser implements Tool
{
    /**
     * @param  OneDriveService  $service  Microsoft Graph OneDrive API client.
     */
    public function __construct(
        private OneDriveService $service,
    ) {}

    public function name(): string
    {
        return 'onedrive_get_current_user';
    }

    public function description(): string
    {
        return 'Get the profile of the currently authenticated Microsoft user. Returns display name, email, job title, and other profile details.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Fetch signed-in user profile details.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('OneDrive integration is not configured.');
            }

            $user = $this->service->getCurrentUser();

            return ToolResult::success([
                'id' => $user['id'] ?? null,
                'display_name' => $user['displayName'] ?? null,
                'email' => $user['mail'] ?? $user['userPrincipalName'] ?? null,
                'job_title' => $user['jobTitle'] ?? null,
                'office_location' => $user['officeLocation'] ?? null,
                'phone' => $user['businessPhones'][0] ?? null,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
