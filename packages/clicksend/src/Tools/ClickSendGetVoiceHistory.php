<?php

namespace OpenCompany\Integrations\ClickSend\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\ClickSend\ClickSendService;

/**
 * Retrieve voice message history from ClickSend.
 *
 * Supports page-based pagination to browse previously sent voice messages.
 */
class ClickSendGetVoiceHistory implements Tool
{
    /**
     * @param  ClickSendService  $service  The ClickSend API client
     */
    public function __construct(
        private ClickSendService $service,
    ) {}

    public function name(): string
    {
        return 'clicksend_get_voice_history';
    }

    public function description(): string
    {
        return 'Get voice message history from ClickSend with pagination.';
    }

    public function parameters(): array
    {
        return [
            'limit' => [
                'type' => 'integer',
                'description' => 'Number of records per page (default 15).',
            ],
            'page' => [
                'type' => 'integer',
                'description' => 'Page number for pagination (default 1).',
            ],
        ];
    }

    /**
     * Get voice history from ClickSend.
     *
     * @param  array<string, mixed>  $args  Tool arguments (limit, page)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('ClickSend integration is not configured.');
            }

            $params = [];

            if (isset($args['limit'])) {
                $params['limit'] = (int) $args['limit'];
            }
            if (isset($args['page'])) {
                $params['page'] = (int) $args['page'];
            }

            $result = $this->service->getVoiceHistory($params);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
