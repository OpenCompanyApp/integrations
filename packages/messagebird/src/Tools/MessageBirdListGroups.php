<?php

namespace OpenCompany\Integrations\MessageBird\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\MessageBird\MessageBirdService;

/**
 * List MessageBird contact groups.
 *
 * Returns groups from the Groups API.
 */
class MessageBirdListGroups implements Tool
{
    /** @param  MessageBirdService  $service  The MessageBird REST API client */
    public function __construct(private MessageBirdService $service) {}

    public function name(): string { return 'messagebird_list_groups'; }

    public function description(): string { return 'List MessageBird contact groups.'; }

    public function parameters(): array
    {
        return ['limit' => ['type' => 'integer', 'description' => 'Maximum results.'], 'offset' => ['type' => 'integer', 'description' => 'Pagination offset.']];
    }

    /** @param  array<string, mixed>  $args  Tool arguments */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('MessageBird integration is not configured.');
            }

            return ToolResult::success($this->service->listGroups(array_filter([
                'limit' => isset($args['limit']) ? (int) $args['limit'] : null,
                'offset' => isset($args['offset']) ? (int) $args['offset'] : null,
            ], static fn (mixed $value): bool => $value !== null)));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
