<?php

namespace OpenCompany\Integrations\ClickUp\Triggers;

use OpenCompany\IntegrationCore\Contracts\TriggerContext;
use OpenCompany\IntegrationCore\Support\TriggerResult;

/**
 * Triggered when a new task is created in ClickUp.
 *
 * Enriches the event payload with full task data.
 */
class ClickUpTaskCreatedTrigger extends ClickUpWebhookTrigger
{
    public function name(): string
    {
        return 'clickup_task_created';
    }

    public function description(): string
    {
        return 'Triggered when a new task is created in ClickUp. Returns the full task data.';
    }

    public function parameters(): array
    {
        return [
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
        ];
    }

    public function onEnable(TriggerContext $ctx): void
    {
        $config = $ctx->config();

        $body = [
            'endpoint' => $ctx->webhookUrl(),
            'events' => ['taskCreated'],
        ];

        foreach (['space_id', 'folder_id', 'list_id'] as $scope) {
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

    public function process(TriggerContext $ctx, array $payload): TriggerResult
    {
        $taskId = $payload['task_id'] ?? null;

        $event = [
            'event' => 'taskCreated',
            'task_id' => $taskId,
            'history_items' => $payload['history_items'] ?? [],
        ];

        if ($taskId) {
            try {
                $event['task'] = $this->service->getTask($taskId);
            } catch (\Throwable $e) {
                $event['task_fetch_error'] = $e->getMessage();
            }
        }

        return TriggerResult::event($event);
    }
}
