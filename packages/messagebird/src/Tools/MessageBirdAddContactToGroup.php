<?php

namespace OpenCompany\Integrations\MessageBird\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\MessageBird\MessageBirdService;

/**
 * Add a contact to a MessageBird group.
 *
 * Creates a contact-group membership.
 */
class MessageBirdAddContactToGroup implements Tool
{
    /** @param  MessageBirdService  $service  The MessageBird REST API client */
    public function __construct(private MessageBirdService $service) {}

    public function name(): string { return 'messagebird_add_contact_to_group'; }

    public function description(): string { return 'Add a contact to a MessageBird group.'; }

    public function parameters(): array
    {
        return ['group_id' => ['type' => 'string', 'required' => true, 'description' => 'Group ID.'], 'contact_id' => ['type' => 'string', 'required' => true, 'description' => 'Contact ID.']];
    }

    /** @param  array<string, mixed>  $args  Tool arguments */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('MessageBird integration is not configured.');
            }

            return ToolResult::success($this->service->addContactToGroup((string) ($args['group_id'] ?? ''), (string) ($args['contact_id'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
