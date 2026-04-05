<?php

namespace OpenCompany\Integrations\Trello\Tools;

use OpenCompany\Integrations\Trello\TrelloService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Add a member to a Trello card.
 */
class TrelloAddMemberToCard implements Tool
{
    /**
     * @param  TrelloService  $service  The Trello API client
     */
    public function __construct(
        private TrelloService $service,
    ) {}

    public function name(): string
    {
        return 'trello_add_member_to_card';
    }

    public function description(): string
    {
        return 'Add a member to a Trello card.';
    }

    public function parameters(): array
    {
        return [
            'id'    => ['type' => 'string', 'required' => true, 'description' => 'The card ID.'],
            'value' => ['type' => 'string', 'required' => true, 'description' => 'The member ID to add.'],
        ];
    }

    /**
     * Assign a member to a card.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id, value)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Trello integration is not configured.');
            }

            $id = $args['id'] ?? '';
            $value = $args['value'] ?? '';

            if (empty($id)) {
                return ToolResult::error('id (card ID) is required.');
            }
            if (empty($value)) {
                return ToolResult::error('value (member ID) is required.');
            }

            $result = $this->service->addMemberToCard($id, $value);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
