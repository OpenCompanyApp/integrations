<?php

namespace OpenCompany\Integrations\Webflow\Tools;

use OpenCompany\Integrations\Webflow\WebflowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a new webhook for a Webflow site.
 */
class WebflowCreateWebhook implements Tool
{
    /**
     * @param  WebflowService  $service  The Webflow API client
     */
    public function __construct(
        private WebflowService $service,
    ) {}

    public function name(): string
    {
        return 'webflow_create_webhook';
    }

    public function description(): string
    {
        return <<<'MD'
        Create a new webhook for a Webflow site.
        Provide a trigger type (e.g. form_submission, site_publish, collection_item_created)
        and a callback URL to receive the webhook payloads.
        MD;
    }

    public function parameters(): array
    {
        return [
            'site_id' => ['type' => 'string', 'required' => true, 'description' => 'The ID of the Webflow site.'],
            'trigger_type' => ['type' => 'string', 'required' => true, 'description' => 'The event trigger type (e.g. form_submission, site_publish, collection_item_created, collection_item_updated, collection_item_deleted).'],
            'url' => ['type' => 'string', 'required' => true, 'description' => 'The callback URL to receive webhook payloads.'],
        ];
    }

    /**
     * Create a webhook for a site with the specified trigger type and callback URL.
     *
     * @param  array<string, mixed>  $args  Tool arguments (site_id, trigger_type, url)
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Webflow integration is not configured.');
            }

            $siteId = $args['site_id'] ?? '';
            $triggerType = $args['trigger_type'] ?? '';
            $url = $args['url'] ?? '';

            if (empty($siteId)) {
                return ToolResult::error('site_id is required.');
            }

            if (empty($triggerType)) {
                return ToolResult::error('trigger_type is required.');
            }

            if (empty($url)) {
                return ToolResult::error('url is required.');
            }

            $result = $this->service->createWebhook($siteId, $triggerType, $url);

            return ToolResult::success([
                'id' => $result['id'] ?? '',
                'triggerType' => $result['triggerType'] ?? $triggerType,
                'url' => $result['url'] ?? $url,
            ]);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
