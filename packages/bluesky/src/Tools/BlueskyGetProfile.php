<?php

namespace OpenCompany\Integrations\Bluesky\Tools;

use OpenCompany\Integrations\Bluesky\BlueskyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool: bluesky_get_profile
 *
 * Retrieve the profile of a Bluesky user by their handle or DID via the
 * {@link GET /xrpc/app.bsky.actor.getProfile} endpoint.
 *
 * Returns display name, description, avatar, banner, follower/following counts,
 * and other profile metadata.
 *
 * @see https://docs.bsky.app/docs/api/app-bsky-actor-get-profile
 */
class BlueskyGetProfile implements Tool
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
        return 'bluesky_get_profile';
    }

    /**
     * Human-readable description shown to the AI agent.
     */
    public function description(): string
    {
        return 'Get the public profile of a Bluesky user. Provide a handle (e.g. "alice.bsky.social") or DID.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'actor' => ['type' => 'string', 'required' => true, 'description' => 'Handle (e.g. "alice.bsky.social") or DID (e.g. "did:plc:...").'],
        ];
    }

    /**
     * Execute the tool — fetch the profile.
     *
     * @param  array  $args  Tool arguments (see {@see parameters()}).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Bluesky integration is not configured.');
            }

            $result = $this->service->getProfile($args['actor']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
