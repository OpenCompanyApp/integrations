<?php

namespace OpenCompany\Integrations\MessageBird\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\MessageBird\MessageBirdService;

/**
 * Create a MessageBird contact.
 *
 * Creates a contact with msisdn, names, and custom details.
 */
class MessageBirdCreateContact implements Tool
{
    /**
     * @param  MessageBirdService  $service  The MessageBird REST API client
     */
    public function __construct(private MessageBirdService $service) {}

    public function name(): string { return 'messagebird_create_contact'; }

    public function description(): string { return 'Create a MessageBird contact.'; }

    public function parameters(): array
    {
        return ['contact' => ['type' => 'object', 'required' => true, 'description' => 'Contact payload with msisdn, firstName, lastName, customDetails.']];
    }

    /**
     * Create contact.
     *
     * @param  array<string, mixed>  $args  Tool arguments
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('MessageBird integration is not configured.');
            }

            return ToolResult::success($this->service->createContact($args['contact'] ?? []));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
