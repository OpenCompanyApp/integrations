<?php

namespace OpenCompany\Integrations\Gotify\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Gotify\GotifyService;

/**
 * Delete a Gotify client with an elevated client token.
 */
class GotifyDeleteClient implements Tool
{
    /**
     * @param  GotifyService  $service  The Gotify API client.
     */
    public function __construct(
        private GotifyService $service,
    ) {}

    public function name(): string
    {
        return 'gotify_delete_client';
    }

    public function description(): string
    {
        return 'Delete a Gotify client. Gotify requires elevated authentication for this endpoint.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'Client ID.'],
        ];
    }

    /**
     * Delete a Gotify client.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isClientConfigured()) {
                return ToolResult::error('Gotify client token is not configured. Deleting clients requires a client token.');
            }

            $id = (int) ($args['id'] ?? 0);
            if ($id <= 0) {
                return ToolResult::error('A valid positive client id is required.');
            }

            $this->service->deleteClient($id);

            return ToolResult::success("Gotify client {$id} has been deleted.");
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
