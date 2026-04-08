<?php

namespace OpenCompany\Integrations\Novu\Tools;

use OpenCompany\Integrations\Novu\NovuService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class NovuListNotifications implements Tool
{
    public function __construct(
        private NovuService $service,
    ) {}

    public function name(): string
    {
        return 'novu_list_notifications';
    }

    public function description(): string
    {
        return 'List notifications from Novu. Returns a paginated list of notifications, optionally filtered by channel (e.g., in_app, email, sms, chat, push).';
    }

    public function parameters(): array
    {
        return [
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (1-based, default: 1).'],
            'limit' => ['type' => 'integer', 'description' => 'Number of notifications per page (default: 10, max: 100).'],
            'channel' => ['type' => 'string', 'description' => 'Filter by notification channel. Options: in_app, email, sms, chat, push.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Novu integration is not configured.');
            }

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $limit = isset($args['limit']) ? (int) $args['limit'] : 10;
            $channel = $args['channel'] ?? null;

            $result = $this->service->listNotifications($page, $limit, $channel);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
