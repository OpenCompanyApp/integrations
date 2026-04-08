<?php

namespace OpenCompany\Integrations\Mastodon\Tools;

use OpenCompany\Integrations\Mastodon\MastodonService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * MastodonGetCurrentUser — retrieve the authenticated user's profile.
 *
 * Calls /api/v1/accounts/verify_credentials to get the current
 * user's account information including display name, bio, and stats.
 */
class MastodonGetCurrentUser implements Tool
{
    public function __construct(
        private MastodonService $service,
    ) {}

    public function name(): string
    {
        return 'mastodon_get_current_user';
    }

    public function description(): string
    {
        return 'Get the authenticated user\'s Mastodon profile. Returns display name, bio, follower/following counts, and other account details.';
    }

    public function parameters(): array
    {
        return [];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mastodon integration is not configured.');
            }

            $account = $this->service->getCurrentUser();

            return ToolResult::success($this->formatAccount($account));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Format an account for a cleaner response.
     *
     * @param  array<string, mixed>  $account
     * @return array<string, mixed>
     */
    private function formatAccount(array $account): array
    {
        return [
            'id' => $account['id'] ?? null,
            'username' => $account['username'] ?? null,
            'display_name' => $account['display_name'] ?? null,
            'acct' => $account['acct'] ?? null,
            'url' => $account['url'] ?? null,
            'note' => $account['note'] ?? '',
            'avatar' => $account['avatar'] ?? null,
            'header' => $account['header'] ?? null,
            'followers_count' => $account['followers_count'] ?? 0,
            'following_count' => $account['following_count'] ?? 0,
            'statuses_count' => $account['statuses_count'] ?? 0,
            'bot' => $account['bot'] ?? false,
            'locked' => $account['locked'] ?? false,
            'created_at' => $account['created_at'] ?? null,
            'source' => [
                'privacy' => $account['source']['privacy'] ?? null,
                'sensitive' => $account['source']['sensitive'] ?? false,
                'language' => $account['source']['language'] ?? null,
            ],
            'fields' => $account['fields'] ?? [],
        ];
    }
}
