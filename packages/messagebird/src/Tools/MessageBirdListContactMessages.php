<?php

namespace OpenCompany\Integrations\MessageBird\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\MessageBird\MessageBirdService;

/**
 * List messages for a MessageBird contact.
 *
 * Retrieves messages associated with a contact.
 */
class MessageBirdListContactMessages implements Tool
{
    /**
     * @param  MessageBirdService  $service  The MessageBird REST API client
     */
    public function __construct(private MessageBirdService $service) {}

    public function name(): string { return 'messagebird_list_contact_messages'; }

    public function description(): string { return 'List MessageBird messages for a contact.'; }

    public function parameters(): array
    {
        return ['id' => ['type' => 'string', 'required' => true, 'description' => 'Contact ID.'], 'params' => ['type' => 'object', 'description' => 'Optional query parameters.']];
    }

    /**
     * List contact messages.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('MessageBird integration is not configured.');
            }

            return ToolResult::success($this->service->listContactMessages((string) ($args['id'] ?? ''), $args['params'] ?? []));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
