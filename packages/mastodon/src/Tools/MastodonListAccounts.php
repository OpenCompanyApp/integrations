<?php

namespace OpenCompany\Integrations\Mastodon\Tools;

use OpenCompany\Integrations\Mastodon\MastodonService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * MastodonListAccounts — list followers of a Mastodon account.
 *
 * Retrieves a paginated list of accounts that follow the specified user.
 * Supports pagination via max_id cursor.
 */
class MastodonListAccounts implements Tool
{
    public function __construct(
        private MastodonService $service,
    ) {}

    public function name(): string
    {
        return 'mastodon_list_accounts';
    }

    public function description(): string
    {
        return 'List followers of a Mastodon account. Returns account profiles with display names, bios, and follower counts. Supports pagination.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The account ID whose followers to list.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of accounts to return (1–80, default: 40).'],
            'max_id' => ['type' => 'string', 'description' => 'Return results older than this account ID (for pagination).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Mastodon integration is not configured.');
            }

            $id = $args['id'];
            $limit = isset($args['limit']) ? (int) $args['limit'] : 40;
            $maxId = $args['max_id'] ?? null;

            $accounts = $this->service->listAccounts($id, $limit, $maxId);

            $formatted = array_map([$this, 'formatAccount'], $accounts);

            return ToolResult::success([
                'account_id' => $id,
                'followers' => $formatted,
                'count' => count($formatted),
            ]);
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
            'followers_count' => $account['followers_count'] ?? 0,
            'following_count' => $account['following_count'] ?? 0,
            'statuses_count' => $account['statuses_count'] ?? 0,
            'bot' => $account['bot'] ?? false,
        ];
    }
}
