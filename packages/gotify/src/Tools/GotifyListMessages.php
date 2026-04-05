<?php

namespace OpenCompany\Integrations\Gotify\Tools;

use OpenCompany\Integrations\Gotify\GotifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GotifyListMessages implements Tool
{
    public function __construct(
        private GotifyService $service,
    ) {}

    public function name(): string
    {
        return 'gotify_list_messages';
    }

    public function description(): string
    {
        return 'List messages from the Gotify application. Returns the most recent messages, with optional pagination using "since" to fetch messages newer than a given ID.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of messages to return (default: 100, max: 200).'],
            'since' => ['type' => 'integer', 'description' => 'Return messages with ID greater than this value. Useful for polling new messages.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Gotify integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 100;
            $since = isset($args['since']) ? (int) $args['since'] : null;

            $result = $this->service->listMessages($limit, $since);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
