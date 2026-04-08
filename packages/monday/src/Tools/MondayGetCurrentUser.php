<?php

namespace OpenCompany\Integrations\Monday\Tools;

use OpenCompany\Integrations\Monday\MondayService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve the currently authenticated Monday.com user's profile.
 */
class MondayGetCurrentUser implements Tool
{
    /**
     * @param  MondayService  $service  The Monday.com API client
     */
    public function __construct(
        private MondayService $service,
    ) {}

    public function name(): string
    {
        return 'monday_get_current_user';
    }

    public function description(): string
    {
        return <<<'MD'
        Get the currently authenticated Monday.com user's profile, including
        ID, name, email, avatar URL, title, location, and timezone.
        MD;
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Fetch the authenticated Monday.com user profile.
     *
     * @param  array<string, mixed>  $args  Tool arguments (unused)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Monday.com integration is not configured.');
            }

            $result = $this->service->getCurrentUser();
            $me = $result['data']['me'] ?? null;

            if ($me === null) {
                return ToolResult::error('Failed to retrieve current user.');
            }

            return ToolResult::success([
                'id' => $me['id'] ?? '',
                'name' => $me['name'] ?? '',
                'email' => $me['email'] ?? '',
                'avatar_url' => $me['avatar_url'] ?? null,
                'title' => $me['title'] ?? null,
                'country_code' => $me['country_code'] ?? null,
                'location' => $me['location'] ?? null,
                'phone' => $me['phone'] ?? null,
                'timezone' => $me['timezone'] ?? null,
                'join_date' => $me['join_date'] ?? null,
                'enabled' => $me['enabled'] ?? true,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
