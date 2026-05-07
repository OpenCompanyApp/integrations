<?php

namespace OpenCompany\Integrations\Gotify\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Gotify\GotifyService;

/**
 * Create a Gotify client with a client token.
 */
class GotifyCreateClient implements Tool
{
    /**
     * @param  GotifyService  $service  The Gotify API client.
     */
    public function __construct(
        private GotifyService $service,
    ) {}

    public function name(): string
    {
        return 'gotify_create_client';
    }

    public function description(): string
    {
        return 'Create a Gotify client and return its generated client token. Requires a client token.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Client name.'],
        ];
    }

    /**
     * Create a Gotify client.
     *
     * @param  array<string, mixed>  $args  Tool arguments (name).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isClientConfigured()) {
                return ToolResult::error('Gotify client token is not configured. Creating clients requires a client token.');
            }

            $name = $args['name'] ?? '';
            if ($name === '') {
                return ToolResult::error('name is required.');
            }

            return ToolResult::success($this->service->createClient(['name' => $name]));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
