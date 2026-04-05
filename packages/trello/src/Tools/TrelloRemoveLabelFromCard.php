<?php

namespace OpenCompany\Integrations\Trello\Tools;

use OpenCompany\Integrations\Trello\TrelloService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Remove a label from a Trello card.
 */
class TrelloRemoveLabelFromCard implements Tool
{
    /**
     * @param  TrelloService  $service  The Trello API client
     */
    public function __construct(
        private TrelloService $service,
    ) {}

    public function name(): string
    {
        return 'trello_remove_label_from_card';
    }

    public function description(): string
    {
        return 'Remove a label from a Trello card.';
    }

    public function parameters(): array
    {
        return [
            'id_card'  => ['type' => 'string', 'required' => true, 'description' => 'The card ID.'],
            'id_label' => ['type' => 'string', 'required' => true, 'description' => 'The label ID to remove.'],
        ];
    }

    /**
     * Detach a label from a card.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id_card, id_label)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Trello integration is not configured.');
            }

            $idCard = $args['id_card'] ?? '';
            $idLabel = $args['id_label'] ?? '';

            if (empty($idCard)) {
                return ToolResult::error('id_card is required.');
            }
            if (empty($idLabel)) {
                return ToolResult::error('id_label is required.');
            }

            $this->service->removeLabelFromCard($idCard, $idLabel);

            return ToolResult::success([
                'removed'  => true,
                'id_card'  => $idCard,
                'id_label' => $idLabel,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
