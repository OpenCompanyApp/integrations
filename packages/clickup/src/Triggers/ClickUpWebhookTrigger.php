<?php

namespace OpenCompany\Integrations\ClickUp\Triggers;

use OpenCompany\IntegrationCore\Contracts\Trigger;
use OpenCompany\IntegrationCore\Contracts\TriggerContext;
use OpenCompany\IntegrationCore\Support\TriggerResult;
use OpenCompany\IntegrationCore\Support\TriggerType;
use OpenCompany\Integrations\ClickUp\ClickUpService;

/**
 * General-purpose ClickUp webhook trigger.
 *
 * Accepts configurable event types and optional scope filters.
 * Use this when you need to listen for any combination of ClickUp events,
 * or extend it for focused convenience triggers.
 */
class ClickUpWebhookTrigger extends Trigger
{
    public function __construct(
        protected ClickUpService $service,
    ) {}

    public function name(): string
    {
        return 'clickup_webhook';
    }

    public function description(): string
    {
        return 'Receive ClickUp workspace events via webhook. Configure which events to listen for and optionally scope to a space, folder, list, or task.';
    }

    public function type(): TriggerType
    {
        return TriggerType::Webhook;
    }

    public function parameters(): array
    {
        return [
            'events' => [
                'type' => 'array',
                'required' => true,
                'items' => ['type' => 'string'],
                'description' => 'ClickUp event types to subscribe to.',
                'enum' => [
                    'taskCreated', 'taskUpdated', 'taskDeleted',
                    'taskStatusUpdated', 'taskAssigneeUpdated', 'taskPriorityUpdated',
                    'taskDueDateUpdated', 'taskTagUpdated', 'taskMoved',
                    'taskCommentPosted', 'taskCommentUpdated',
                    'taskTimeEstimateUpdated', 'taskTimeTrackedUpdated',
                    'listCreated', 'listUpdated', 'listDeleted',
                    'folderCreated', 'folderUpdated', 'folderDeleted',
                    'spaceCreated', 'spaceUpdated', 'spaceDeleted',
                    'goalCreated', 'goalUpdated', 'goalDeleted',
                    'keyResultCreated', 'keyResultUpdated', 'keyResultDeleted',
                ],
            ],
            'space_id' => [
                'type' => 'string',
                'description' => 'Scope to a specific space (optional).',
            ],
            'folder_id' => [
                'type' => 'string',
                'description' => 'Scope to a specific folder (optional).',
            ],
            'list_id' => [
                'type' => 'string',
                'description' => 'Scope to a specific list (optional).',
            ],
            'task_id' => [
                'type' => 'string',
                'description' => 'Scope to a specific task (optional).',
            ],
        ];
    }

    public function onEnable(TriggerContext $ctx): void
    {
        $config = $ctx->config();

        $body = [
            'endpoint' => $ctx->webhookUrl(),
            'events' => $config['events'] ?? ['taskCreated', 'taskUpdated'],
        ];

        foreach (['space_id', 'folder_id', 'list_id', 'task_id'] as $scope) {
            if (! empty($config[$scope])) {
                $body[$scope] = $config[$scope];
            }
        }

        $response = $this->service->createWebhook(
            $this->service->getWorkspaceId(),
            $body,
        );

        $webhook = $response['webhook'] ?? $response;

        $ctx->store()->put('webhook_id', $webhook['id'] ?? '');
        $ctx->store()->put('webhook_secret', $webhook['secret'] ?? '');
    }

    public function onDisable(TriggerContext $ctx): void
    {
        $webhookId = $ctx->store()->get('webhook_id');

        if ($webhookId) {
            try {
                $this->service->deleteWebhook($webhookId);
            } catch (\Throwable) {
                // Webhook may already be deleted externally
            }
        }

        $ctx->store()->forget('webhook_id');
        $ctx->store()->forget('webhook_secret');
    }

    public function verify(TriggerContext $ctx, array $headers, string $rawBody): bool
    {
        $secret = $ctx->store()->get('webhook_secret', '');

        if (empty($secret)) {
            return true;
        }

        $signature = $headers['x-signature'] ?? '';

        if (empty($signature)) {
            return false;
        }

        $expected = hash_hmac('sha256', $rawBody, $secret);

        return hash_equals($expected, $signature);
    }

    public function process(TriggerContext $ctx, array $payload): TriggerResult
    {
        $event = [
            'event' => $payload['event'] ?? 'unknown',
            'task_id' => $payload['task_id'] ?? null,
            'webhook_id' => $payload['webhook_id'] ?? null,
            'history_items' => $payload['history_items'] ?? [],
        ];

        foreach (['list_id', 'folder_id', 'space_id', 'goal_id', 'key_result_id'] as $field) {
            if (isset($payload[$field])) {
                $event[$field] = $payload[$field];
            }
        }

        return TriggerResult::event($event);
    }
}
