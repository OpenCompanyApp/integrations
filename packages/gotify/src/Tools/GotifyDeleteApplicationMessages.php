<?php

namespace OpenCompany\Integrations\Gotify\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Gotify\GotifyService;

/**
 * Delete all messages for one Gotify application with a client token.
 */
class GotifyDeleteApplicationMessages implements Tool
{
    /**
     * @param  GotifyService  $service  The Gotify API client.
     */
    public function __construct(
        private GotifyService $service,
    ) {}

    public function name(): string
    {
        return 'gotify_delete_application_messages';
    }

    public function description(): string
    {
        return 'Delete all messages sent by a specific Gotify application. Requires a client token.';
    }

    public function parameters(): array
    {
        return [
            'application_id' => ['type' => 'integer', 'required' => true, 'description' => 'Gotify application ID.'],
        ];
    }

    /**
     * Delete all messages for one application.
     *
     * @param  array<string, mixed>  $args  Tool arguments (application_id).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isClientConfigured()) {
                return ToolResult::error('Gotify client token is not configured. Deleting application messages requires a client token.');
            }

            $applicationId = (int) ($args['application_id'] ?? 0);
            if ($applicationId <= 0) {
                return ToolResult::error('A valid positive application_id is required.');
            }

            $this->service->deleteApplicationMessages($applicationId);

            return ToolResult::success("Messages for Gotify application {$applicationId} have been deleted.");
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
