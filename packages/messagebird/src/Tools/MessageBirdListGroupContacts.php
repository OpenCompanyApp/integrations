<?php

namespace OpenCompany\Integrations\MessageBird\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\MessageBird\MessageBirdService;

/**
 * List contacts in a MessageBird group.
 *
 * Retrieves contacts assigned to a group.
 */
class MessageBirdListGroupContacts implements Tool
{
    /** @param  MessageBirdService  $service  The MessageBird REST API client */
    public function __construct(private MessageBirdService $service) {}

    public function name(): string { return 'messagebird_list_group_contacts'; }

    public function description(): string { return 'List contacts in a MessageBird group.'; }

    public function parameters(): array
    {
        return ['id' => ['type' => 'string', 'required' => true, 'description' => 'Group ID.'], 'params' => ['type' => 'object', 'description' => 'Optional query parameters.']];
    }

    /** @param  array<string, mixed>  $args  Tool arguments */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('MessageBird integration is not configured.');
            }

            return ToolResult::success($this->service->listGroupContacts((string) ($args['id'] ?? ''), $args['params'] ?? []));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
