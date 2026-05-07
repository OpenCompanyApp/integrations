<?php

namespace OpenCompany\Integrations\Webex\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List Webex webhooks.
 */
class WebexListWebhooks extends AbstractWebexTool implements Tool
{
    public function name(): string
    {
        return 'webex_list_webhooks';
    }

    public function description(): string
    {
        return 'List Webex webhooks for the authenticated token.';
    }

    public function parameters(): array
    {
        return [
            'max' => ['type' => 'integer', 'description' => 'Maximum results to return.'],
        ];
    }

    /**
     * Fetch webhooks.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if ($error = $this->requireConfigured()) {
                return $error;
            }

            return ToolResult::success($this->service->listWebhooks($this->only($args, ['max'])));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
