<?php

namespace OpenCompany\Integrations\MessageBird\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\MessageBird\MessageBirdService;

/**
 * Create a MessageBird Verify request.
 *
 * Sends a verification token by SMS, flash, TTS, or email.
 */
class MessageBirdCreateVerify implements Tool
{
    /** @param  MessageBirdService  $service  The MessageBird REST API client */
    public function __construct(private MessageBirdService $service) {}

    public function name(): string { return 'messagebird_create_verify'; }

    public function description(): string { return 'Create a MessageBird Verify request and send a token.'; }

    public function parameters(): array
    {
        return ['recipient' => ['type' => 'string', 'required' => true, 'description' => 'Phone number or email to verify.'], 'options' => ['type' => 'object', 'description' => 'Optional verify parameters: originator, reference, type, template, timeout, tokenLength, datacoding.']];
    }

    /** @param  array<string, mixed>  $args  Tool arguments */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('MessageBird integration is not configured.');
            }

            return ToolResult::success($this->service->createVerify((string) ($args['recipient'] ?? ''), $args['options'] ?? []));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
