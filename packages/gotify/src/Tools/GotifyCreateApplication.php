<?php

namespace OpenCompany\Integrations\Gotify\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Gotify\GotifyService;

/**
 * Create a Gotify application with a client token.
 */
class GotifyCreateApplication implements Tool
{
    /**
     * @param  GotifyService  $service  The Gotify API client.
     */
    public function __construct(
        private GotifyService $service,
    ) {}

    public function name(): string
    {
        return 'gotify_create_application';
    }

    public function description(): string
    {
        return 'Create a Gotify application and return its generated application token. Requires a client token.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Application name.'],
            'description' => ['type' => 'string', 'description' => 'Application description.'],
        ];
    }

    /**
     * Create a Gotify application.
     *
     * @param  array<string, mixed>  $args  Tool arguments (name, description).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isClientConfigured()) {
                return ToolResult::error('Gotify client token is not configured. Creating applications requires a client token.');
            }

            $name = $args['name'] ?? '';
            if ($name === '') {
                return ToolResult::error('name is required.');
            }

            return ToolResult::success($this->service->createApplication([
                'name' => $name,
                'description' => $args['description'] ?? '',
            ]));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
