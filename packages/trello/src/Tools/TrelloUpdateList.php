<?php

namespace OpenCompany\Integrations\Trello\Tools;

use OpenCompany\Integrations\Trello\TrelloService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update a Trello list's name or archived state.
 */
class TrelloUpdateList implements Tool
{
    /**
     * @param  TrelloService  $service  The Trello API client
     */
    public function __construct(
        private TrelloService $service,
    ) {}

    public function name(): string
    {
        return 'trello_update_list';
    }

    public function description(): string
    {
        return 'Update a Trello list.';
    }

    public function parameters(): array
    {
        return [
            'id'     => ['type' => 'string',  'required' => true, 'description' => 'The list ID to update.'],
            'name'   => ['type' => 'string',  'description' => 'New name for the list.'],
            'closed' => ['type' => 'boolean', 'description' => 'Set to true to archive the list.'],
        ];
    }

    /**
     * Update a list's fields.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id, name, closed)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Trello integration is not configured.');
            }

            $id = $args['id'] ?? '';

            if (empty($id)) {
                return ToolResult::error('id is required.');
            }

            $data = [];

            if (array_key_exists('name', $args)) {
                $data['name'] = $args['name'];
            }
            if (array_key_exists('closed', $args)) {
                $data['closed'] = $args['closed'];
            }

            $list = $this->service->updateList($id, $data);

            return ToolResult::success($list);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
