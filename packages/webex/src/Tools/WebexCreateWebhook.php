<?php

namespace OpenCompany\Integrations\Webex\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a Webex webhook.
 */
class WebexCreateWebhook extends AbstractWebexTool implements Tool
{
    public function name(): string
    {
        return 'webex_create_webhook';
    }

    public function description(): string
    {
        return 'Create a Webex webhook for events such as created messages or memberships.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Webhook name.'],
            'targetUrl' => ['type' => 'string', 'required' => true, 'description' => 'HTTPS webhook target URL.'],
            'resource' => ['type' => 'string', 'required' => true, 'description' => 'Resource such as messages, rooms, or memberships.'],
            'event' => ['type' => 'string', 'required' => true, 'description' => 'Event such as created, updated, or deleted.'],
            'filter' => ['type' => 'string', 'description' => 'Optional Webex webhook filter string.'],
            'secret' => ['type' => 'string', 'description' => 'Optional webhook signing secret.'],
            'payload' => ['type' => 'object', 'description' => 'Additional official webhook fields.'],
        ];
    }

    /**
     * Create a webhook.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }
            foreach (['name', 'targetUrl', 'resource', 'event'] as $required) {
                if (empty($args[$required])) {
                    return ToolResult::error($required.' is required.');
                }
            }

            $payload = is_array($args['payload'] ?? null) ? $args['payload'] : [];
            $payload = array_merge($payload, $this->only($args, ['name', 'targetUrl', 'resource', 'event', 'filter', 'secret']));

            return ToolResult::success($this->service->createWebhook($payload));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
