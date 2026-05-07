<?php

namespace OpenCompany\Integrations\Gotify\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Gotify\GotifyService;

/**
 * Delete all Gotify messages visible to the configured client token.
 */
class GotifyDeleteMessages implements Tool
{
    /**
     * @param  GotifyService  $service  The Gotify API client.
     */
    public function __construct(
        private GotifyService $service,
    ) {}

    public function name(): string
    {
        return 'gotify_delete_messages';
    }

    public function description(): string
    {
        return 'Delete all Gotify messages visible to the configured client token.';
    }

    public function parameters(): array
    {
        return [];
    }

    /**
     * Delete all visible messages.
     *
     * @param  array<string, mixed>  $args  Tool arguments; none are required.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isClientConfigured()) {
                return ToolResult::error('Gotify client token is not configured. Deleting messages requires a client token.');
            }

            $this->service->deleteMessages();

            return ToolResult::success('All visible Gotify messages have been deleted.');
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
