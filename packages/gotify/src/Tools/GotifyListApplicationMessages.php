<?php

namespace OpenCompany\Integrations\Gotify\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Gotify\GotifyService;

/**
 * List messages for one Gotify application with a client token.
 */
class GotifyListApplicationMessages implements Tool
{
    /**
     * @param  GotifyService  $service  The Gotify API client.
     */
    public function __construct(
        private GotifyService $service,
    ) {}

    public function name(): string
    {
        return 'gotify_list_application_messages';
    }

    public function description(): string
    {
        return 'List messages sent by a specific Gotify application. Requires a client token.';
    }

    public function parameters(): array
    {
        return [
            'application_id' => ['type' => 'integer', 'required' => true, 'description' => 'Gotify application ID.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of messages to return (default: 100, max: 200).'],
            'since' => ['type' => 'integer', 'description' => 'Return messages with ID less than this value.'],
        ];
    }

    /**
     * List messages for one application.
     *
     * @param  array<string, mixed>  $args  Tool arguments (application_id, limit, since).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isClientConfigured()) {
                return ToolResult::error('Gotify client token is not configured. Listing application messages requires a client token.');
            }

            $applicationId = (int) ($args['application_id'] ?? 0);
            if ($applicationId <= 0) {
                return ToolResult::error('A valid positive application_id is required.');
            }

            $limit = min(max((int) ($args['limit'] ?? 100), 1), 200);
            $since = isset($args['since']) ? (int) $args['since'] : null;

            return ToolResult::success($this->service->listApplicationMessages($applicationId, $limit, $since));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
