<?php

namespace OpenCompany\Integrations\Telegram\Tools;

use OpenCompany\Integrations\Telegram\TelegramService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get incoming updates for the Telegram bot.
 *
 * Returns an array of Update objects including messages, callback queries,
 * and other interactions. Used for polling new events.
 */
class TelegramListUpdates implements Tool
{
    public function __construct(
        private TelegramService $service,
    ) {}

    public function name(): string
    {
        return 'telegram_list_updates';
    }

    public function description(): string
    {
        return 'Get incoming updates (messages, callback queries, inline queries, etc.) for the Telegram bot. Use offset to acknowledge previously received updates. Returns an array of update objects.';
    }

    public function parameters(): array
    {
        return [
            'offset' => ['type' => 'integer', 'description' => 'Identifier of the first update to return. Must be greater by one than the highest previously received update_id.'],
            'limit' => ['type' => 'integer', 'description' => 'Number of updates to fetch (1–100). Default: 100.'],
            'timeout' => ['type' => 'integer', 'description' => 'Long polling timeout in seconds. Default: 0 (no long polling).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Telegram integration is not configured.');
            }

            $offset = isset($args['offset']) ? (int) $args['offset'] : null;
            $limit = isset($args['limit']) ? (int) $args['limit'] : 100;
            $timeout = isset($args['timeout']) ? (int) $args['timeout'] : 0;

            $result = $this->service->listUpdates($offset, $limit, $timeout);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
