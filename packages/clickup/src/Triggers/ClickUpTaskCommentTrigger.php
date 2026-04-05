<?php

namespace OpenCompany\Integrations\ClickUp\Triggers;

use OpenCompany\IntegrationCore\Contracts\TriggerContext;
use OpenCompany\IntegrationCore\Support\TriggerResult;

/**
 * Triggered when a comment is posted on a ClickUp task.
 *
 * Enriches the event payload with full task data.
 */
class ClickUpTaskCommentTrigger extends ClickUpWebhookTrigger
{
    public function name(): string
    {
        return 'clickup_task_comment';
    }

    public function description(): string
    {
        return 'Triggered when a comment is posted on a task in ClickUp. Returns the comment details and full task data.';
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
            'events' => ['taskCommentPosted'],
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
            'event' => 'taskCommentPosted',
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
