<?php

namespace OpenCompany\Integrations\Webex\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Webex rooms visible to the authenticated user.
 */
class WebexListRooms extends AbstractWebexTool implements Tool
{
    public function name(): string
    {
        return 'webex_list_rooms';
    }

    public function description(): string
    {
        return 'List Webex spaces (rooms) the authenticated user belongs to. Returns room IDs, titles, types, and last activity timestamps. Use for discovering available rooms before reading messages or posting.';
    }

    public function parameters(): array
    {
        return [
            'max' => ['type' => 'integer', 'description' => 'Maximum number of rooms to return (1-1000, default: 100).'],
            'before' => ['type' => 'string', 'description' => 'List rooms before this ISO 8601 timestamp (for pagination).'],
            'after' => ['type' => 'string', 'description' => 'List rooms after this ISO 8601 timestamp (for pagination).'],
        ];
    }

    /**
     * List rooms.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }

            $max = isset($args['max']) ? (int) $args['max'] : 100;
            $result = $this->service->listRooms(
                $max,
                $args['before'] ?? null,
                $args['after'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
