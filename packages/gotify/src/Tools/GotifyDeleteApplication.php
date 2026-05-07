<?php

namespace OpenCompany\Integrations\Gotify\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Gotify\GotifyService;

/**
 * Delete a Gotify application with an elevated client token.
 */
class GotifyDeleteApplication implements Tool
{
    /**
     * @param  GotifyService  $service  The Gotify API client.
     */
    public function __construct(
        private GotifyService $service,
    ) {}

    public function name(): string
    {
        return 'gotify_delete_application';
    }

    public function description(): string
    {
        return 'Delete a Gotify application. Gotify requires elevated authentication for this endpoint.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'Application ID.'],
        ];
    }

    /**
     * Delete a Gotify application.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isClientConfigured()) {
                return ToolResult::error('Gotify client token is not configured. Deleting applications requires a client token.');
            }

            $id = (int) ($args['id'] ?? 0);
            if ($id <= 0) {
                return ToolResult::error('A valid positive application id is required.');
            }

            $this->service->deleteApplication($id);

            return ToolResult::success("Gotify application {$id} has been deleted.");
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
