<?php

namespace OpenCompany\Integrations\Gotify\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Gotify\GotifyService;

/**
 * Update a Gotify application with a client token.
 */
class GotifyUpdateApplication implements Tool
{
    /**
     * @param  GotifyService  $service  The Gotify API client.
     */
    public function __construct(
        private GotifyService $service,
    ) {}

    public function name(): string
    {
        return 'gotify_update_application';
    }

    public function description(): string
    {
        return 'Update a Gotify application name and description. Requires a client token.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'Application ID.'],
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Application name.'],
            'description' => ['type' => 'string', 'description' => 'Application description.'],
        ];
    }

    /**
     * Update a Gotify application.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id, name, description).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isClientConfigured()) {
                return ToolResult::error('Gotify client token is not configured. Updating applications requires a client token.');
            }

            $id = (int) ($args['id'] ?? 0);
            $name = $args['name'] ?? '';
            if ($id <= 0 || $name === '') {
                return ToolResult::error('id and name are required.');
            }

            return ToolResult::success($this->service->updateApplication($id, [
                'name' => $name,
                'description' => $args['description'] ?? '',
            ]));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
