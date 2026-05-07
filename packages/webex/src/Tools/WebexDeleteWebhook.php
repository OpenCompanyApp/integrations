<?php

namespace OpenCompany\Integrations\Webex\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a Webex webhook.
 */
class WebexDeleteWebhook extends AbstractWebexTool implements Tool
{
    public function name(): string
    {
        return 'webex_delete_webhook';
    }

    public function description(): string
    {
        return 'Delete a Webex webhook by webhook ID.';
    }

    public function parameters(): array
    {
        return [
            'webhook_id' => ['type' => 'string', 'required' => true, 'description' => 'Webhook ID.'],
        ];
    }

    /**
     * Delete a webhook.
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

            return ToolResult::success($this->service->deleteWebhook((string) $args['webhook_id']));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
