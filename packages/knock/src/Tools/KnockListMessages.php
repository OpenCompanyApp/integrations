<?php

namespace OpenCompany\Integrations\Knock\Tools;

use OpenCompany\Integrations\Knock\KnockService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class KnockListMessages implements Tool
{
    public function __construct(
        private KnockService $service,
    ) {}

    public function name(): string
    {
        return 'knock_list_messages';
    }

    public function description(): string
    {
        return 'List notification messages from Knock. Optionally filter by delivery status (e.g., sent, delivered, undelivered).';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of messages to return (default: 25).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination.'],
            'status' => ['type' => 'string', 'description' => 'Filter by message status: sent, delivered, undelivered, or opened.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Knock integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 25;
            $page = isset($args['page']) ? (int) $args['page'] : null;
            $status = $args['status'] ?? null;

            $result = $this->service->listMessages($limit, $page, $status);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
