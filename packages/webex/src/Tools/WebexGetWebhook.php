<?php

namespace OpenCompany\Integrations\Webex\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a Webex webhook by ID.
 */
class WebexGetWebhook extends AbstractWebexTool implements Tool
{
    public function name(): string
    {
        return 'webex_get_webhook';
    }

    public function description(): string
    {
        return 'Get details for one Webex webhook by webhook ID.';
    }

    public function parameters(): array
    {
        return [
            'webhook_id' => ['type' => 'string', 'required' => true, 'description' => 'Webhook ID.'],
        ];
    }

    /**
     * Fetch one webhook.
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

            return ToolResult::success($this->service->getWebhook((string) $args['webhook_id']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
