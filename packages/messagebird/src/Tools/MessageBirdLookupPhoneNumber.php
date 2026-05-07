<?php

namespace OpenCompany\Integrations\MessageBird\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\MessageBird\MessageBirdService;

/**
 * Look up a phone number with MessageBird.
 *
 * Returns normalized number, country, and type details.
 */
class MessageBirdLookupPhoneNumber implements Tool
{
    /** @param  MessageBirdService  $service  The MessageBird REST API client */
    public function __construct(private MessageBirdService $service) {}

    public function name(): string { return 'messagebird_lookup_phone_number'; }

    public function description(): string { return 'Validate and look up a phone number with MessageBird Lookup.'; }

    public function parameters(): array
    {
        return ['phone_number' => ['type' => 'string', 'required' => true, 'description' => 'Phone number to look up.'], 'country_code' => ['type' => 'string', 'description' => 'Optional ISO country code for national numbers.']];
    }

    /** @param  array<string, mixed>  $args  Tool arguments */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('MessageBird integration is not configured.');
            }

            return ToolResult::success($this->service->lookupPhoneNumber((string) ($args['phone_number'] ?? ''), isset($args['country_code']) ? (string) $args['country_code'] : null));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
