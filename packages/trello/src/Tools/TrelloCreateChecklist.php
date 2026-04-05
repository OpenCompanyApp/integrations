<?php

namespace OpenCompany\Integrations\Trello\Tools;

use OpenCompany\Integrations\Trello\TrelloService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new checklist on a Trello card.
 */
class TrelloCreateChecklist implements Tool
{
    /**
     * @param  TrelloService  $service  The Trello API client
     */
    public function __construct(
        private TrelloService $service,
    ) {}

    public function name(): string
    {
        return 'trello_create_checklist';
    }

    public function description(): string
    {
        return 'Create a new checklist on a Trello card.';
    }

    public function parameters(): array
    {
        return [
            'id_card' => ['type' => 'string', 'required' => true, 'description' => 'The card ID to add the checklist to.'],
            'name'    => ['type' => 'string', 'required' => true, 'description' => 'Name for the checklist.'],
        ];
    }

    /**
     * Create a new checklist on the specified card.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id_card, name)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Trello integration is not configured.');
            }

            $idCard = $args['id_card'] ?? '';
            $name = $args['name'] ?? '';

            if (empty($idCard)) {
                return ToolResult::error('id_card is required.');
            }
            if (empty($name)) {
                return ToolResult::error('name is required.');
            }

            $checklist = $this->service->createChecklist([
                'idCard' => $idCard,
                'name'   => $name,
            ]);

            return ToolResult::success($checklist);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
