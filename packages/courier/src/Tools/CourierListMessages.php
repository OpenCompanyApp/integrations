<?php

namespace OpenCompany\Integrations\Courier\Tools;

use OpenCompany\Integrations\Courier\CourierService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class CourierListMessages implements Tool
{
    public function __construct(
        private CourierService $service,
    ) {}

    public function name(): string
    {
        return 'courier_list_messages';
    }

    public function description(): string
    {
        return 'List messages from Courier with optional filtering by status and cursor-based pagination. Returns message IDs, statuses, and metadata.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of messages to return (default: 20, max: 200).'],
            'cursor' => ['type' => 'string', 'description' => 'Pagination cursor — pass the cursor from a previous response to fetch the next page.'],
            'status' => ['type' => 'string', 'description' => 'Filter by message status. Possible values: "delivered", "undelivered", "opened", "clicked", "bounced", "enqueued".'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Courier integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : null;
            $cursor = $args['cursor'] ?? null;
            $status = $args['status'] ?? null;

            $result = $this->service->listMessages($limit, $cursor, $status);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
