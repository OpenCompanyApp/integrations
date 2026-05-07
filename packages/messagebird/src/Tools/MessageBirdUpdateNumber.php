<?php

namespace OpenCompany\Integrations\MessageBird\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\MessageBird\MessageBirdService;

/**
 * Update a purchased MessageBird number.
 *
 * Patches number settings such as SMS or voice URLs when supported by the account.
 */
class MessageBirdUpdateNumber implements Tool
{
    /** @param  MessageBirdService  $service  The MessageBird REST API client */
    public function __construct(private MessageBirdService $service) {}

    public function name(): string { return 'messagebird_update_number'; }

    public function description(): string { return 'Update settings for a purchased MessageBird phone number.'; }

    public function parameters(): array
    {
        return ['number' => ['type' => 'string', 'required' => true, 'description' => 'Purchased phone number.'], 'settings' => ['type' => 'object', 'required' => true, 'description' => 'Number settings to update.']];
    }

    /** @param  array<string, mixed>  $args  Tool arguments */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('MessageBird integration is not configured.');
            }

            return ToolResult::success($this->service->updateNumber((string) ($args['number'] ?? ''), $args['settings'] ?? []));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
