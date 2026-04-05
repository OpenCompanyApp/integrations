<?php

namespace OpenCompany\Integrations\Trello\Tools;

use OpenCompany\Integrations\Trello\TrelloService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new Trello board.
 */
class TrelloCreateBoard implements Tool
{
    /**
     * @param  TrelloService  $service  The Trello API client
     */
    public function __construct(
        private TrelloService $service,
    ) {}

    public function name(): string
    {
        return 'trello_create_board';
    }

    public function description(): string
    {
        return 'Create a new Trello board.';
    }

    public function parameters(): array
    {
        return [
            'name'           => ['type' => 'string',  'required' => true,  'description' => 'Name for the new board.'],
            'desc'           => ['type' => 'string',  'description' => 'Board description.'],
            'default_labels' => ['type' => 'boolean', 'description' => 'Whether to add default labels (default: true).'],
            'default_lists'  => ['type' => 'boolean', 'description' => 'Whether to add default lists (default: true).'],
        ];
    }

    /**
     * Create a new board with optional description and defaults.
     *
     * @param  array<string, mixed>  $args  Tool arguments (name, desc, default_labels, default_lists)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Trello integration is not configured.');
            }

            $name = $args['name'] ?? '';

            if (empty($name)) {
                return ToolResult::error('name is required.');
            }

            $data = ['name' => $name];

            if (isset($args['desc'])) {
                $data['desc'] = $args['desc'];
            }
            if (array_key_exists('default_labels', $args)) {
                $data['defaultLabels'] = (bool) $args['default_labels'];
            }
            if (array_key_exists('default_lists', $args)) {
                $data['defaultLists'] = (bool) $args['default_lists'];
            }

            $board = $this->service->createBoard($data);

            return ToolResult::success($board);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
