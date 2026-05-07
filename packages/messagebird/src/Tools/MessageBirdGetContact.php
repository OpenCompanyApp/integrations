<?php

namespace OpenCompany\Integrations\MessageBird\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\MessageBird\MessageBirdService;

/**
 * Get a MessageBird contact.
 *
 * Retrieves a contact by contact ID.
 */
class MessageBirdGetContact implements Tool
{
    /**
     * @param  MessageBirdService  $service  The MessageBird REST API client
     */
    public function __construct(private MessageBirdService $service) {}

    public function name(): string { return 'messagebird_get_contact'; }

    public function description(): string { return 'Get a MessageBird contact by ID.'; }

    public function parameters(): array
    {
        return ['id' => ['type' => 'string', 'required' => true, 'description' => 'Contact ID.']];
    }

    /**
     * Get contact.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('MessageBird integration is not configured.');
            }

            return ToolResult::success($this->service->getContact((string) ($args['id'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
