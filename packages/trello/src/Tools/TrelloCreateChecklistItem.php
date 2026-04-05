<?php

namespace OpenCompany\Integrations\Trello\Tools;

use OpenCompany\Integrations\Trello\TrelloService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Add an item to an existing Trello checklist.
 */
class TrelloCreateChecklistItem implements Tool
{
    /**
     * @param  TrelloService  $service  The Trello API client
     */
    public function __construct(
        private TrelloService $service,
    ) {}

    public function name(): string
    {
        return 'trello_create_checklist_item';
    }

    public function description(): string
    {
        return 'Add an item to a Trello checklist.';
    }

    public function parameters(): array
    {
        return [
            'id'      => ['type' => 'string',  'required' => true, 'description' => 'The checklist ID.'],
            'name'    => ['type' => 'string',  'required' => true, 'description' => 'Text for the checklist item.'],
            'checked' => ['type' => 'boolean', 'description' => 'Whether the item starts checked (default: false).'],
        ];
    }

    /**
     * Add a new item to a checklist.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id, name, checked)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Trello integration is not configured.');
            }

            $id = $args['id'] ?? '';
            $name = $args['name'] ?? '';

            if (empty($id)) {
                return ToolResult::error('id (checklist ID) is required.');
            }
            if (empty($name)) {
                return ToolResult::error('name is required.');
            }

            $data = ['name' => $name];

            if (isset($args['checked'])) {
                $data['checked'] = (bool) $args['checked'];
            }

            $item = $this->service->createChecklistItem($id, $data);

            return ToolResult::success($item);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
