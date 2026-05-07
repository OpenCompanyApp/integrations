<?php

namespace OpenCompany\Integrations\Gotify\Tools;

use OpenCompany\Integrations\Gotify\GotifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete one Gotify message with a client token.
 */
class GotifyDeleteMessage implements Tool
{
    /**
     * @param  GotifyService  $service  The Gotify API client.
     */
    public function __construct(
        private GotifyService $service,
    ) {}

    public function name(): string
    {
        return 'gotify_delete_message';
    }

    public function description(): string
    {
        return 'Delete a message from Gotify by its ID. Use the list_messages tool to find message IDs.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'integer', 'required' => true, 'description' => 'The ID of the message to delete.'],
        ];
    }

    /**
     * Delete a Gotify message by id.
     *
     * @param  array<string, mixed>  $args  Tool arguments (id).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isClientConfigured()) {
                return ToolResult::error('Gotify client token is not configured. Deleting messages requires a client token.');
            }

            $id = (int) ($args['id'] ?? 0);
            if ($id <= 0) {
                return ToolResult::error('A valid positive message id is required.');
            }

            $this->service->deleteMessage($id);

            return ToolResult::success("Message {$id} has been deleted.");
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
