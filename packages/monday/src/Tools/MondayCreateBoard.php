<?php

namespace OpenCompany\Integrations\Monday\Tools;

use OpenCompany\Integrations\Monday\MondayService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new board on Monday.com.
 *
 * Uses the `create_board` mutation to create a board, optionally
 * within a specific workspace and with a given board kind.
 */
class MondayCreateBoard implements Tool
{
    /**
     * @param  MondayService  $service  The Monday.com API client
     */
    public function __construct(
        private MondayService $service,
    ) {}

    public function name(): string
    {
        return 'monday_create_board';
    }

    public function description(): string
    {
        return 'Create a new board on Monday.com.';
    }

    public function parameters(): array
    {
        return [
            'board_name'    => ['type' => 'string',  'required' => true,  'description' => 'The name of the new board.'],
            'workspace_id'  => ['type' => 'integer', 'description' => 'The ID of the workspace to create the board in.'],
            'board_kind'    => ['type' => 'string',  'description' => 'The board kind: "public", "private", or "share". Defaults to "public".'],
        ];
    }

    /**
     * Create a new board with the given name and options.
     *
     * @param  array<string, mixed>  $args  Tool arguments (board_name, workspace_id, board_kind)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Monday.com integration is not configured.');
            }

            $boardName = $args['board_name'] ?? '';

            if (empty($boardName)) {
                return ToolResult::error('board_name is required.');
            }

            $escapedName = $this->escapeGraphQL($boardName);

            $params = "board_name: \"{$escapedName}\"";

            if (isset($args['workspace_id']) && ! empty($args['workspace_id'])) {
                $params .= ", workspace_id: {$args['workspace_id']}";
            }

            $boardKind = $args['board_kind'] ?? 'public';
            $params .= ", board_kind: {$boardKind}";

            $query = "mutation { create_board ({$params}) { id name } }";

            $result = $this->service->graphql($query);

            return ToolResult::success($result['create_board'] ?? []);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Escape a string for safe embedding in a GraphQL query.
     *
     * @param  string  $value  The raw string value
     * @return string  The escaped string
     */
    private function escapeGraphQL(string $value): string
    {
        return str_replace(
            ['\\', '"', "\n", "\r", "\t"],
            ['\\\\', '\\"', '\\n', '\\r', '\\t'],
            $value,
        );
    }
}
