<?php

namespace OpenCompany\Integrations\Plane\Triggers;

use OpenCompany\IntegrationCore\Contracts\Trigger;
use OpenCompany\IntegrationCore\Contracts\TriggerContext;
use OpenCompany\IntegrationCore\Support\TriggerResult;
use OpenCompany\IntegrationCore\Support\TriggerType;
use OpenCompany\Integrations\Plane\PlaneService;

/**
 * Webhook trigger for Plane.so workspace events.
 *
 * Registers a webhook with Plane.so and processes incoming payloads for
 * issue lifecycle events (created, updated, deleted), comment events, and more.
 */
class PlaneWebhookTrigger extends Trigger
{
    /**
     * @param  PlaneService  $service  The Plane.so API client
     */
    public function __construct(
        protected PlaneService $service,
    ) {}

    public function name(): string
    {
        return 'plane_webhook';
    }

    public function description(): string
    {
        return 'Receive Plane.so workspace events via webhook. Configure which events to listen for and optionally scope to a project.';
    }

    public function type(): TriggerType
    {
        return TriggerType::Webhook;
    }

    public function parameters(): array
    {
        return [
            'workspace_slug' => [
                'type' => 'string',
                'required' => false,
                'description' => 'The workspace slug to register the webhook for.',
            ],
            'project_id' => [
                'type' => 'string',
                'description' => 'Optional project UUID to scope the webhook.',
            ],
        ];
    }

    public function onEnable(TriggerContext $ctx): void
    {
        $config = $ctx->config();
        $workspaceSlug = $this->service->resolveWorkspaceSlug($config['workspace_slug'] ?? null);

        $body = [
            'url' => $ctx->webhookUrl(),
            'is_active' => true,
        ];

        $response = $this->service->createWebhook($workspaceSlug, $body);

        $ctx->store()->put('webhook_id', $response['id'] ?? '');
        $ctx->store()->put('workspace_slug', $workspaceSlug);
    }

    public function onDisable(TriggerContext $ctx): void
    {
        $webhookId = $ctx->store()->get('webhook_id');
        $workspaceSlug = $ctx->store()->get('workspace_slug');

        if ($webhookId && $workspaceSlug) {
            try {
                $this->service->deleteWebhook($workspaceSlug, $webhookId);
            } catch (\Throwable) {
                // Webhook may already be deleted externally
            }
        }

        $ctx->store()->forget('webhook_id');
        $ctx->store()->forget('workspace_slug');
    }

    public function verify(TriggerContext $ctx, array $headers, string $rawBody): bool
    {
        $signature = $headers['x-plane-signature'] ?? $headers['X-Plane-Signature'] ?? '';

        if (empty($signature)) {
            return true;
        }

        $secret = $ctx->store()->get('webhook_secret', '');

        if (empty($secret)) {
            return true;
        }

        $expected = hash_hmac('sha256', $rawBody, $secret);

        return hash_equals($expected, $signature);
    }

    public function process(TriggerContext $ctx, array $payload): TriggerResult
    {
        $event = [
            'event' => $payload['event'] ?? $payload['action'] ?? 'unknown',
            'data' => $payload['data'] ?? $payload,
        ];

        foreach (['workspace_slug', 'project_id', 'issue_id', 'actor_id'] as $field) {
            if (isset($payload[$field])) {
                $event[$field] = $payload[$field];
            }
        }

        return TriggerResult::event($event);
    }
}
