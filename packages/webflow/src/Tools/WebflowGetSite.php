<?php

namespace OpenCompany\Integrations\Webflow\Tools;

use OpenCompany\Integrations\Webflow\WebflowService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class WebflowGetSite implements Tool
{
    public function __construct(
        private WebflowService $service,
    ) {}

    public function name(): string
    {
        return 'webflow_get_site';
    }

    public function description(): string
    {
        return 'Get details for a specific Webflow site by its ID. Returns site name, domain, publishing status, and other metadata.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The unique identifier of the Webflow site (e.g., "641d84b8f0bca14670785897").'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Webflow integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Site ID is required.');
            }

            $result = $this->service->getSite($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
