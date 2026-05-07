<?php

namespace OpenCompany\Integrations\Devin\Tools;

use OpenCompany\Integrations\Devin\DevinService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Devin sessions for the configured account or organization.
 *
 * Accepts v3 cursor filters and legacy v1 list filters.
 */
class DevinListSessions implements Tool
{
    /**
     * @param  DevinService  $service  The Devin API client.
     */
    public function __construct(
        private DevinService $service,
    ) {}

    public function name(): string
    {
        return 'devin_list_sessions';
    }

    public function description(): string
    {
        return 'List Devin sessions. Current v3 accounts support cursor and timestamp filters; legacy v1 accounts support basic pagination and tag filters.';
    }

    public function parameters(): array
    {
        return [
            'first' => ['type' => 'integer', 'description' => 'Maximum v3 records to return.'],
            'after' => ['type' => 'string', 'description' => 'Cursor for v3 pagination.'],
            'session_ids' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Optional v3 session ID filter.'],
            'created_after' => ['type' => 'string', 'description' => 'Optional v3 created-after timestamp.'],
            'created_before' => ['type' => 'string', 'description' => 'Optional v3 created-before timestamp.'],
            'updated_after' => ['type' => 'string', 'description' => 'Optional v3 updated-after timestamp.'],
            'updated_before' => ['type' => 'string', 'description' => 'Optional v3 updated-before timestamp.'],
            'playbook_id' => ['type' => 'string', 'description' => 'Optional v3 playbook filter.'],
            'origins' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Optional v3 origin filters such as api, cli, slack, or webapp.'],
            'schedule_id' => ['type' => 'string', 'description' => 'Optional v3 schedule ID filter.'],
            'user_ids' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Optional v3 user ID filters.'],
            'service_user_ids' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Optional v3 service user ID filters.'],
            'limit' => ['type' => 'integer', 'description' => 'Legacy v1 limit.'],
            'offset' => ['type' => 'integer', 'description' => 'Legacy v1 offset.'],
            'skip' => ['type' => 'integer', 'description' => 'Legacy v1 skip count.'],
            'tags' => ['type' => 'array', 'items' => ['type' => 'string'], 'description' => 'Legacy v1 tag filter.'],
            'user_email' => ['type' => 'string', 'description' => 'Legacy v1 user email filter.'],
        ];
    }

    /**
     * List sessions.
     *
     * @param  array<string, mixed>  $args  Optional pagination and filter arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Devin integration is not configured.');
            }

            $result = $this->service->listSessions($args);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
