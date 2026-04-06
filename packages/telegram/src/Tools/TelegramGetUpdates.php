<?php

namespace OpenCompany\Integrations\Telegram\Tools;

use OpenCompany\Integrations\Telegram\TelegramService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for retrieving incoming updates from the Telegram Bot API.
 *
 * Fetches pending updates (messages, callback queries, etc.) for the bot.
 * Supports pagination via offset and filtering via allowed_updates.
 */
class TelegramGetUpdates implements Tool
{
    public function __construct(
        private TelegramService $service,
    ) {}

    public function name(): string
    {
        return 'telegram_get_updates';
    }

    public function description(): string
    {
        return 'Get incoming updates for the bot — new messages, callback queries, and other events. Use offset to acknowledge updates and limit to control batch size.';
    }

    public function parameters(): array
    {
        return [
            'offset' => ['type' => 'integer', 'description' => 'Identifier of the first update to return. Must be one greater than the last received update_id to acknowledge it.'],
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of updates to return (1-100, default: 100).'],
            'timeout' => ['type' => 'integer', 'description' => 'Long polling timeout in seconds (0-300, default: 0 for short polling).'],
            'allowed_updates' => ['type' => 'array', 'description' => 'Types of updates to receive, e.g. ["message", "callback_query"]. Omit to receive all.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Telegram integration is not configured.');
            }

            $params = [];
            if (isset($args['offset'])) {
                $params['offset'] = (int) $args['offset'];
            }
            if (isset($args['limit'])) {
                $params['limit'] = min(100, max(1, (int) $args['limit']));
            }
            if (isset($args['timeout'])) {
                $params['timeout'] = min(300, max(0, (int) $args['timeout']));
            }
            if (isset($args['allowed_updates'])) {
                $params['allowed_updates'] = $args['allowed_updates'];
            }

            $result = $this->service->getUpdates($params);

            $updates = $result['result'] ?? $result;

            return ToolResult::success([
                'updates' => $updates,
                'count' => count($updates),
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
