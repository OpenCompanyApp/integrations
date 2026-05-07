<?php

namespace OpenCompany\Integrations\MessageBird\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\MessageBird\MessageBirdService;

/**
 * Create a MessageBird contact group.
 *
 * Creates a new group by name.
 */
class MessageBirdCreateGroup implements Tool
{
    /** @param  MessageBirdService  $service  The MessageBird REST API client */
    public function __construct(private MessageBirdService $service) {}

    public function name(): string { return 'messagebird_create_group'; }

    public function description(): string { return 'Create a MessageBird contact group.'; }

    public function parameters(): array { return ['name' => ['type' => 'string', 'required' => true, 'description' => 'Group name.']]; }

    /** @param  array<string, mixed>  $args  Tool arguments */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('MessageBird integration is not configured.');
            }

            return ToolResult::success($this->service->createGroup((string) ($args['name'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
