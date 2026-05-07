<?php

namespace OpenCompany\Integrations\Webex\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update a Webex webhook.
 */
class WebexUpdateWebhook extends AbstractWebexTool implements Tool
{
    public function name(): string
    {
        return 'webex_update_webhook';
    }

    public function description(): string
    {
        return 'Update a Webex webhook by webhook ID.';
    }

    public function parameters(): array
    {
        return [
            'webhook_id' => ['type' => 'string', 'required' => true, 'description' => 'Webhook ID.'],
            'name' => ['type' => 'string', 'description' => 'Webhook name.'],
            'targetUrl' => ['type' => 'string', 'description' => 'HTTPS webhook target URL.'],
            'status' => ['type' => 'string', 'description' => 'Webhook status when supported.'],
            'payload' => ['type' => 'object', 'description' => 'Additional official webhook update fields.'],
        ];
    }

    /**
     * Update a webhook.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }
            if (empty($args['webhook_id'])) {
                return ToolResult::error('webhook_id is required.');
            }

            $payload = is_array($args['payload'] ?? null) ? $args['payload'] : [];
            $payload = array_merge($payload, $this->only($args, ['name', 'targetUrl', 'status']));
            if ($payload === []) {
                return ToolResult::error('At least one update field is required.');
            }

            return ToolResult::success($this->service->updateWebhook((string) $args['webhook_id'], $payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
