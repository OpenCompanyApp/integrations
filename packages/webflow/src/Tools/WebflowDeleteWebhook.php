<?php

namespace OpenCompany\Integrations\Webflow\Tools;

use OpenCompany\Integrations\Webflow\WebflowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a webhook from a Webflow site.
 */
class WebflowDeleteWebhook implements Tool
{
    /**
     * @param  WebflowService  $service  The Webflow API client
     */
    public function __construct(
        private WebflowService $service,
    ) {}

    public function name(): string
    {
        return 'webflow_delete_webhook';
    }

    public function description(): string
    {
        return <<<'MD'
        Delete a webhook from a Webflow site by its ID.
        This action is irreversible.
        MD;
    }

    public function parameters(): array
    {
        return [
            'site_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the Webflow site.'],
            'webhook_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the webhook to delete.'],
        ];
    }

    /**
     * Delete a webhook from a site by its ID.
     *
     * @param  array<string, mixed>  $args  Tool arguments (site_id, webhook_id)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Webflow integration is not configured.');
            }

            $siteId = $args['site_id'] ?? '';
            $webhookId = $args['webhook_id'] ?? '';

            if (empty($siteId)) {
                return ToolResult::error('site_id is required.');
            }

            if (empty($webhookId)) {
                return ToolResult::error('webhook_id is required.');
            }

            $this->service->deleteWebhook($siteId, $webhookId);

            return ToolResult::success([
                'deleted' => true,
                'webhook_id' => $webhookId,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
