<?php

namespace OpenCompany\Integrations\MessageBird\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\MessageBird\MessageBirdService;

/**
 * Get a MessageBird HLR lookup.
 *
 * Retrieves existing HLR information for a phone number.
 */
class MessageBirdGetHlrLookup implements Tool
{
    /** @param  MessageBirdService  $service  The MessageBird REST API client */
    public function __construct(private MessageBirdService $service) {}

    public function name(): string { return 'messagebird_get_hlr_lookup'; }

    public function description(): string { return 'Get MessageBird HLR lookup information for a phone number.'; }

    public function parameters(): array { return ['phone_number' => ['type' => 'string', 'required' => true, 'description' => 'Phone number.']]; }

    /** @param  array<string, mixed>  $args  Tool arguments */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('MessageBird integration is not configured.');
            }

            return ToolResult::success($this->service->getHlrLookup((string) ($args['phone_number'] ?? '')));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
