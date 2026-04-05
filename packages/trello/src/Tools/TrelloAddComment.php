<?php

namespace OpenCompany\Integrations\Trello\Tools;

use OpenCompany\Integrations\Trello\TrelloService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Add a comment to a Trello card.
 */
class TrelloAddComment implements Tool
{
    /**
     * @param  TrelloService  $service  The Trello API client
     */
    public function __construct(
        private TrelloService $service,
    ) {}

    public function name(): string
    {
        return 'trello_add_comment';
    }

    public function description(): string
    {
        return 'Add a comment to a Trello card.';
    }

    public function parameters(): array
    {
        return [
            'id'   => ['type' => 'string', 'required' => true, 'description' => 'The card ID.'],
            'text' => ['type' => 'string', 'required' => true, 'description' => 'Comment text (supports Markdown).'],
        ];
    }

    /**
     * Post a comment on a card.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id, text)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Trello integration is not configured.');
            }

            $id = $args['id'] ?? '';
            $text = $args['text'] ?? '';

            if (empty($id)) {
                return ToolResult::error('id is required.');
            }
            if (empty($text)) {
                return ToolResult::error('text is required.');
            }

            $comment = $this->service->addComment($id, $text);

            return ToolResult::success($comment);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
