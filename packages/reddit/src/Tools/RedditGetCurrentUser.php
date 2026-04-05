<?php

namespace OpenCompany\Integrations\Reddit\Tools;

use OpenCompany\Integrations\Reddit\RedditService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for retrieving the currently authenticated Reddit user's profile.
 *
 * Uses Reddit's `/api/v1/me` endpoint to fetch the identity of the user
 * associated with the OAuth2 access token.
 */
class RedditGetCurrentUser implements Tool
{
    /**
     * Create a new RedditGetCurrentUser tool instance.
     *
     * @param  RedditService  $service  The Reddit API service for making authenticated requests.
     */
    public function __construct(
        private RedditService $service,
    ) {}

    /**
     * Get the tool identifier.
     */
    public function name(): string
    {
        return 'reddit_get_current_user';
    }

    /**
     * Get a human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get the profile of the currently authenticated Reddit user. Returns username, karma, account age, and other profile details.';
    }

    /**
     * Get the parameter schema for this tool.
     *
     * @return array<string, array{type: string, description: string}>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool: fetch the current user's profile.
     *
     * @param  array<string, mixed>  $args  Tool arguments (none required).
     * @return ToolResult The result containing the user profile or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Reddit integration is not configured.');
            }

            $result = $this->service->getCurrentUser();

            return ToolResult::success($this->formatResponse($result));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Format the Reddit /api/v1/me response into a structured profile.
     *
     * @param  array<string, mixed>  $result  Raw Reddit API response.
     * @return array<string, mixed> Formatted user profile.
     */
    private function formatResponse(array $result): array
    {
        return [
            'id' => $result['id'] ?? null,
            'name' => $result['name'] ?? null,
            'linkKarma' => $result['link_karma'] ?? 0,
            'commentKarma' => $result['comment_karma'] ?? 0,
            'totalKarma' => $result['total_karma'] ?? 0,
            'isGold' => $result['is_gold'] ?? false,
            'isMod' => $result['is_mod'] ?? false,
            'isVerified' => $result['verified'] ?? false,
            'hasVerifiedEmail' => $result['has_verified_email'] ?? false,
            'createdUtc' => $result['created_utc'] ?? null,
            'over18' => $result['over_18'] ?? false,
            'iconImg' => $result['icon_img'] ?? null,
            'snoovatarImg' => $result['snoovatar_img'] ?? null,
        ];
    }
}
