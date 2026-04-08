<?php

namespace OpenCompany\Integrations\Loops\Tools;

use OpenCompany\Integrations\Loops\LoopsService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class LoopsSendEvent implements Tool
{
    public function __construct(
        private LoopsService $service,
    ) {}

    public function name(): string
    {
        return 'loops_send_event';
    }

    public function description(): string
    {
        return 'Send a custom event to Loops for a contact identified by email. Events can trigger automations and loops in your Loops account.';
    }

    public function parameters(): array
    {
        return [
            'email' => ['type' => 'string', 'required' => true, 'description' => 'The contact\'s email address.'],
            'event_name' => ['type' => 'string', 'required' => true, 'description' => 'The name of the event to send (e.g., "signup", "purchase", "trial_started").'],
            'properties' => ['type' => 'object', 'description' => 'Optional event properties as key-value pairs to attach additional data.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Loops integration is not configured.');
            }

            if (empty($args['email'])) {
                return ToolResult::error('email is required.');
            }

            if (empty($args['event_name'])) {
                return ToolResult::error('event_name is required.');
            }

            $result = $this->service->sendEvent(
                email: $args['email'],
                eventName: $args['event_name'],
                properties: $args['properties'] ?? [],
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
