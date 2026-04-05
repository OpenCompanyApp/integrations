<?php

namespace OpenCompany\Integrations\Trello\Tools;

use OpenCompany\Integrations\Trello\TrelloService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new label on a Trello board.
 */
class TrelloCreateLabel implements Tool
{
    /**
     * @param  TrelloService  $service  The Trello API client
     */
    public function __construct(
        private TrelloService $service,
    ) {}

    public function name(): string
    {
        return 'trello_create_label';
    }

    public function description(): string
    {
        return 'Create a new label on a Trello board.';
    }

    public function parameters(): array
    {
        return [
            'name'      => ['type' => 'string', 'required' => true, 'description' => 'Name for the label.'],
            'color'     => ['type' => 'string', 'description' => 'Label color (e.g. "green", "yellow", "red", "blue").'],
            'id_board'  => ['type' => 'string', 'required' => true, 'description' => 'ID of the board to create the label on.'],
        ];
    }

    /**
     * Create a new label on the specified board.
     *
     * @param  array<string, mixed>  $args  Tool arguments (name, color, id_board)
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

            if (isset($args['color'])) {
                $data['color'] = $args['color'];
            }

            $label = $this->service->createLabel($data);

            return ToolResult::success($label);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
