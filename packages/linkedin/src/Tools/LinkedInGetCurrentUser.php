<?php

namespace OpenCompany\Integrations\Linkedin\Tools;

use OpenCompany\Integrations\Linkedin\LinkedinService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve the currently authenticated LinkedIn user profile.
 *
 * Returns the user's ID, name, and profile information.
 */
class LinkedinGetCurrentUser implements Tool
{
    /**
     * @param  LinkedinService  $service  The LinkedIn API client
     */
    public function __construct(
        private LinkedinService $service,
    ) {}

    public function name(): string
    {
        return 'linkedin_get_current_user';
    }

    public function description(): string
    {
        return <<<'MD'
        Retrieve the currently authenticated LinkedIn user profile.
        Returns the user's ID, localized name, and profile metadata.
        Useful for identifying which account or token is in use.
        MD;
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Retrieve the currently authenticated LinkedIn user.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('LinkedIn integration is not configured.');
            }

            $result = $this->service->getMe();

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'localized_first_name' => $result['localizedFirstName'] ?? '',
                'localized_last_name' => $result['localizedLastName'] ?? '',
                'first_name' => $result['firstName'] ?? [],
                'last_name' => $result['lastName'] ?? [],
                'profile_picture' => $result['profilePicture'] ?? [],
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
