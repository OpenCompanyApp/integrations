<?php

namespace OpenCompany\Integrations\OneSignal\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Cancel a scheduled or outgoing OneSignal message.
 */
class OneSignalCancelNotification extends AbstractOneSignalTool
{
    public function name(): string
    {
        return 'onesignal_cancel_notification';
    }

    public function description(): string
    {
        return 'Cancel a scheduled or currently outgoing OneSignal message by ID.';
    }

    public function parameters(): array
    {
        return [
            'message_id' => ['type' => 'string', 'required' => true, 'description' => 'Message or notification ID.'],
            'app_id' => ['type' => 'string', 'description' => 'OneSignal App ID. Defaults to configured app_id.'],
        ];
    }

    /**
     * Execute the cancellation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->cancelNotification(
            $this->required($args, 'message_id'),
            $args['app_id'] ?? null,
        ));
    }
}
