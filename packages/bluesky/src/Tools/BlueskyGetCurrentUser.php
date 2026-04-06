<?php

namespace OpenCompany\Integrations\Bluesky\Tools;

use OpenCompany\Integrations\Bluesky\BlueskyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: bluesky_get_current_user
 *
 * Retrieve the authenticated user's own Bluesky profile.
 *
 * This is a convenience wrapper around the
 * {@link GET /xrpc/app.bsky.actor.getProfile} endpoint that automatically
 * resolves the current user by using their configured DID, so the caller
 * does not need to supply an actor parameter.
 *
 * @see https://docs.bsky.app/docs/api/app-bsky-actor-get-profile
 */
class BlueskyGetCurrentUser implements Tool
{
    /**
     * @param  BlueskyService  $service  The Bluesky API client.
     */
    public function __construct(
        private BlueskyService $service,
    ) {}

    /**
     * Machine name of this tool.
     */
    public function name(): string
    {
        return 'bluesky_get_current_user';
    }

    /**
     * Human-readable description shown to the AI agent.
     */
    public function description(): string
    {
        return 'Get the authenticated user\'s own Bluesky profile. No parameters required — uses the configured account.';
    }

    /**
     * Parameter schema — no parameters needed.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Execute the tool — fetch the current user's profile.
     *
     * @param  array  $args  Unused — no parameters required.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Bluesky integration is not configured.');
            }

            $did = $this->service->getDid();

            if (empty($did)) {
                return ToolResult::error('Bluesky DID is not configured. Set the DID in your integration settings.');
            }

            $result = $this->service->getProfile($did);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
