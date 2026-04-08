<?php

namespace OpenCompany\Integrations\Gotify\Tools;

use OpenCompany\Integrations\Gotify\GotifyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class GotifyDeleteMessage implements Tool
{
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

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Gotify integration is not configured.');
            }

            $id = (int) $args['id'];

            $this->service->deleteMessage($id);

            return ToolResult::success("Message {$id} has been deleted.");
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
