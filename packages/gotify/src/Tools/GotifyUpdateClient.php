<?php

namespace OpenCompany\Integrations\Gotify\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Gotify\GotifyService;

/**
 * Update a Gotify client with a client token.
 */
class GotifyUpdateClient implements Tool
{
    /**
     * @param  GotifyService  $service  The Gotify API client.
     */
    public function __construct(
        private GotifyService $service,
    ) {}

    public function name(): string
    {
        return 'gotify_update_client';
    }

    public function description(): string
    {
        return 'Update a Gotify client name. Requires a client token.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'Client ID.'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Client name.'],
        ];
    }

    /**
     * Update a Gotify client.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id, name).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isClientConfigured()) {
                return ToolResult::error('Gotify client token is not configured. Updating clients requires a client token.');
            }

            $id = (int) ($args['id'] ?? 0);
            $name = $args['name'] ?? '';
            if ($id <= 0 || $name === '') {
                return ToolResult::error('id and name are required.');
            }

            return ToolResult::success($this->service->updateClient($id, ['name' => $name]));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
