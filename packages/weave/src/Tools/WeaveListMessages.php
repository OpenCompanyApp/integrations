<?php

namespace OpenCompany\Integrations\Weave\Tools;

use OpenCompany\Integrations\Weave\WeaveService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List messages from the Weave platform.
 *
 * Supports pagination and type-based filtering (e.g. SMS, email).
 * Returns message records including sender, recipient, content
 * previews, timestamps, and delivery status.
 */
class WeaveListMessages implements Tool
{
    public function __construct(
        private WeaveService $service,
    ) {}

    public function name(): string
    {
        return 'weave_list_messages';
    }

    public function description(): string
    {
        return 'List patient messages from Weave with optional type filtering. Returns message records with sender, recipient, content previews, and status.';
    }

    public function parameters(): array
    {
        return [
            'limit' => ['type' => 'integer', 'description' => 'Maximum number of messages to return (default: 25).'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination, 1-based (default: 1).'],
            'type' => ['type' => 'string', 'description' => 'Filter by message type (e.g. "sms", "email").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Weave integration is not configured.');
            }

            $limit = isset($args['limit']) ? (int) $args['limit'] : 25;
            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $type = $args['type'] ?? null;

            $result = $this->service->listMessages($limit, $page, $type);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
