<?php

namespace OpenCompany\Integrations\Trello\Tools;

use OpenCompany\Integrations\Trello\TrelloService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update an existing Trello card.
 */
class TrelloUpdateCard implements Tool
{
    /**
     * @param  TrelloService  $service  The Trello API client
     */
    public function __construct(
        private TrelloService $service,
    ) {}

    public function name(): string
    {
        return 'trello_update_card';
    }

    public function description(): string
    {
        return 'Update an existing Trello card.';
    }

    public function parameters(): array
    {
        return [
            'id'        => ['type' => 'string', 'required' => true,  'description' => 'The card ID to update.'],
            'name'      => ['type' => 'string', 'description' => 'New name for the card.'],
            'desc'      => ['type' => 'string', 'description' => 'New description.'],
            'id_list'   => ['type' => 'string', 'description' => 'Move the card to this list ID.'],
            'id_labels' => ['type' => 'array',  'description' => 'Replace labels with this array of label IDs.'],
            'due'       => ['type' => 'string', 'description' => 'Due date in ISO 8601 format (or null to remove).'],
            'closed'    => ['type' => 'boolean','description' => 'Set to true to archive the card.'],
        ];
    }

    /**
     * Update a card's fields.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id, name, desc, id_list, id_labels, due, closed)
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
            if (array_key_exists('desc', $args)) {
                $data['desc'] = $args['desc'];
            }
            if (array_key_exists('id_list', $args)) {
                $data['idList'] = $args['id_list'];
            }
            if (array_key_exists('id_labels', $args)) {
                $data['idLabels'] = $args['id_labels'];
            }
            if (array_key_exists('due', $args)) {
                $data['due'] = $args['due'];
            }
            if (array_key_exists('closed', $args)) {
                $data['closed'] = $args['closed'];
            }

            $card = $this->service->updateCard($id, $data);

            return ToolResult::success($card);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
