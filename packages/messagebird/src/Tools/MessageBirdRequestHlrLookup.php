<?php

namespace OpenCompany\Integrations\MessageBird\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\MessageBird\MessageBirdService;

/**
 * Request a MessageBird HLR lookup.
 *
 * Starts an HLR lookup for a phone number.
 */
class MessageBirdRequestHlrLookup implements Tool
{
    /** @param  MessageBirdService  $service  The MessageBird REST API client */
    public function __construct(private MessageBirdService $service) {}

    public function name(): string { return 'messagebird_request_hlr_lookup'; }

    public function description(): string { return 'Request a MessageBird HLR lookup for a phone number.'; }

    public function parameters(): array
    {
        return ['phone_number' => ['type' => 'string', 'required' => true, 'description' => 'Phone number.'], 'options' => ['type' => 'object', 'description' => 'Optional HLR lookup parameters.']];
    }

    /** @param  array<string, mixed>  $args  Tool arguments */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('MessageBird integration is not configured.');
            }

            return ToolResult::success($this->service->requestHlrLookup((string) ($args['phone_number'] ?? ''), $args['options'] ?? []));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
