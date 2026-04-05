<?php

namespace OpenCompany\Integrations\Trello\Tools;

use OpenCompany\Integrations\Trello\TrelloService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new list on a Trello board.
 */
class TrelloCreateList implements Tool
{
    /**
     * @param  TrelloService  $service  The Trello API client
     */
    public function __construct(
        private TrelloService $service,
    ) {}

    public function name(): string
    {
        return 'trello_create_list';
    }

    public function description(): string
    {
        return 'Create a new list on a Trello board.';
    }

    public function parameters(): array
    {
        return [
            'name'      => ['type' => 'string', 'required' => true, 'description' => 'Name for the new list.'],
            'id_board'  => ['type' => 'string', 'required' => true, 'description' => 'ID of the board to add the list to.'],
            'pos'       => ['type' => 'string', 'description' => 'Position: "top", "bottom", or a positive number.'],
        ];
    }

    /**
     * Create a new list on the specified board.
     *
     * @param  array<string, mixed>  $args  Tool arguments (name, id_board, pos)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Trello integration is not configured.');
            }

            $name = $args['name'] ?? '';
            $idBoard = $args['id_board'] ?? '';

            if (empty($name)) {
                return ToolResult::error('name is required.');
            }
            if (empty($idBoard)) {
                return ToolResult::error('id_board is required.');
            }

            $data = ['name' => $name, 'idBoard' => $idBoard];

            if (isset($args['pos'])) {
                $data['pos'] = $args['pos'];
            }

            $list = $this->service->createList($data);

            return ToolResult::success($list);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
