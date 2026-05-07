<?php

namespace OpenCompany\Integrations\MessageBird\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\MessageBird\MessageBirdService;

/**
 * Get a purchased MessageBird number.
 *
 * Retrieves configuration for a purchased phone number.
 */
class MessageBirdGetNumber implements Tool
{
    /** @param  MessageBirdService  $service  The MessageBird REST API client */
    public function __construct(private MessageBirdService $service) {}

    public function name(): string { return 'messagebird_get_number'; }

    public function description(): string { return 'Get a purchased MessageBird phone number.'; }

    public function parameters(): array { return ['number' => ['type' => 'string', 'required' => true, 'description' => 'Purchased phone number.']]; }

    /** @param  array<string, mixed>  $args  Tool arguments */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('MessageBird integration is not configured.');
            }

            return ToolResult::success($this->service->getNumber((string) ($args['number'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
