<?php

namespace OpenCompany\Integrations\Trello\Tools;

use OpenCompany\Integrations\Trello\TrelloService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new card on a Trello list.
 */
class TrelloCreateCard implements Tool
{
    /**
     * @param  TrelloService  $service  The Trello API client
     */
    public function __construct(
        private TrelloService $service,
    ) {}

    public function name(): string
    {
        return 'trello_create_card';
    }

    public function description(): string
    {
        return 'Create a new card on a Trello list.';
    }

    public function parameters(): array
    {
        return [
            'name'      => ['type' => 'string',  'required' => true,  'description' => 'Name for the card.'],
            'id_list'   => ['type' => 'string',  'required' => true,  'description' => 'ID of the list to add the card to.'],
            'desc'      => ['type' => 'string',  'description' => 'Description (supports Markdown).'],
            'id_labels' => ['type' => 'array',   'description' => 'Array of label IDs to add.'],
            'id_members'=> ['type' => 'array',   'description' => 'Array of member IDs to assign.'],
            'due'       => ['type' => 'string',  'description' => 'Due date in ISO 8601 format.'],
            'pos'       => ['type' => 'string',  'description' => 'Position: "top", "bottom", or a positive number.'],
        ];
    }

    /**
     * Create a new card with the given details.
     *
     * @param  array<string, mixed>  $args  Tool arguments (name, id_list, desc, id_labels, id_members, due, pos)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Trello integration is not configured.');
            }

            $name = $args['name'] ?? '';
            $idList = $args['id_list'] ?? '';

            if (empty($name)) {
                return ToolResult::error('name is required.');
            }
            if (empty($idList)) {
                return ToolResult::error('id_list is required.');
            }

            $data = ['name' => $name, 'idList' => $idList];

            if (isset($args['desc'])) {
                $data['desc'] = $args['desc'];
            }
            if (isset($args['id_labels'])) {
                $data['idLabels'] = $args['id_labels'];
            }
            if (isset($args['id_members'])) {
                $data['idMembers'] = $args['id_members'];
            }
            if (isset($args['due'])) {
                $data['due'] = $args['due'];
            }
            if (isset($args['pos'])) {
                $data['pos'] = $args['pos'];
            }

            $card = $this->service->createCard($data);

            return ToolResult::success($card);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
