<?php

namespace OpenCompany\IntegrationCore\Contracts;

use OpenCompany\IntegrationCore\Support\TriggerResult;
use OpenCompany\IntegrationCore\Support\TriggerType;

/**
 * Abstract base class for all triggers.
 *
 * Triggers are event sources — they receive events from external services
 * (via webhook) or discover new events (via polling). The host application
 * manages the infrastructure (HTTP endpoints, scheduling, state persistence);
 * the trigger defines what to register, how to verify, and how to process.
 *
 * Webhook triggers override: onEnable, onDisable, process, verify
 * Polling triggers override: onEnable, onDisable, poll
 */
abstract class Trigger
{
    /**
     * Trigger slug used for routing (e.g., 'clickup_task_created').
     */
    abstract public function name(): string;

    /**
     * Human-readable description.
     */
    abstract public function description(): string;

    /**
     * Whether this is a webhook or polling trigger.
     */
    abstract public function type(): TriggerType;

    /**
     * Configuration parameters for this trigger.
     *
     * Same format as Tool::parameters(). Used by the host to render
     * configuration UI and validate user input when enabling a trigger.
     *
     * @return array<string, array{type?: string, required?: bool, description?: string, enum?: array, items?: array, default?: mixed}>
     */
    public function parameters(): array
    {
        return [];
    }

    /**
     * Called when the trigger is enabled/subscribed.
     *
     * For webhooks: register the webhook with the external service.
     * For polling: initialize cursor/checkpoint state.
     *
     * Use $ctx->store() to persist webhook IDs, secrets, cursors.
     * Use $ctx->webhookUrl() to get the URL the external service should POST to.
     */
    abstract public function onEnable(TriggerContext $ctx): void;

    /**
     * Called when the trigger is disabled/unsubscribed.
     *
     * For webhooks: deregister the webhook with the external service.
     * For polling: clean up stored state.
     */
    abstract public function onDisable(TriggerContext $ctx): void;

    /**
     * Process an incoming webhook payload. Only called for webhook triggers.
     *
     * @param  array<string, mixed>  $payload  Parsed JSON body from the webhook POST
     * @return TriggerResult  Zero or more events extracted from the payload
     */
    public function process(TriggerContext $ctx, array $payload): TriggerResult
    {
        return TriggerResult::empty();
    }

    /**
     * Poll for new events. Only called for polling triggers.
     *
     * Use $ctx->store() to read/write cursors and checkpoints.
     *
     * @return TriggerResult  Zero or more new events found since last poll
     */
    public function poll(TriggerContext $ctx): TriggerResult
    {
        return TriggerResult::empty();
    }

    /**
     * Verify the signature of an incoming webhook request.
     *
     * Return true if the request is authentic, false to reject.
     * Override for services that sign payloads (ClickUp HMAC-SHA256, Stripe, GitHub).
     *
     * @param  array<string, string>  $headers  Request headers (lowercase keys)
     * @param  string  $rawBody  Raw request body (before JSON parsing)
     */
    public function verify(TriggerContext $ctx, array $headers, string $rawBody): bool
    {
        return true;
    }

    /**
     * Handle a handshake/challenge request from the external service.
     *
     * Some services (Slack, Zoom) send a challenge request when registering
     * a webhook. Return the expected response array, or null if this isn't
     * a handshake request.
     *
     * @param  array<string, mixed>  $payload  Parsed request body
     * @return array<string, mixed>|null  Response to send back, or null
     */
    public function handshake(array $payload): ?array
    {
        return null;
    }
}
