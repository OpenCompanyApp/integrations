<?php

namespace OpenCompany\Integrations\Novu\Tools;

use OpenCompany\Integrations\Novu\NovuService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class NovuTriggerEvent implements Tool
{
    public function __construct(
        private NovuService $service,
    ) {}

    public function name(): string
    {
        return 'novu_trigger_event';
    }

    public function description(): string
    {
        return 'Trigger a notification event in Novu. Sends a notification based on a workflow template to one or more subscribers. The "to" field can be a subscriber ID, email address, or an array of recipients.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'The workflow trigger key / template name (e.g., "onboarding-welcome").'],
            'to' => ['type' => 'string', 'required' => true, 'description' => 'Recipient — a subscriber ID, email address, or JSON-encoded array of recipient identifiers.'],
            'payload' => ['type' => 'object', 'description' => 'Key-value pairs to pass as template variables (e.g., {"name": "John", "plan": "Pro"}).'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Novu integration is not configured.');
            }

            if (empty($args['name'])) {
                return ToolResult::error('Event name (workflow trigger key) is required.');
            }

            if (empty($args['to'])) {
                return ToolResult::error('Recipient ("to") is required.');
            }

            $to = $args['to'];
            if (is_string($to)) {
                $decoded = json_decode($to, true);
                if (is_array($decoded)) {
                    $to = $decoded;
                }
            }

            $payload = $args['payload'] ?? [];
            if (is_string($payload)) {
                $decoded = json_decode($payload, true);
                if (is_array($decoded)) {
                    $payload = $decoded;
                }
            }

            $result = $this->service->triggerEvent($args['name'], $to, $payload);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
