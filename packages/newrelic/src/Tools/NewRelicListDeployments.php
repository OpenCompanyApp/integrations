<?php

namespace OpenCompany\Integrations\NewRelic\Tools;

use OpenCompany\Integrations\NewRelic\NewRelicService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class NewRelicListDeployments implements Tool
{
    public function __construct(
        private NewRelicService $service,
    ) {}

    public function name(): string
    {
        return 'newrelic_list_deployments';
    }

    public function description(): string
    {
        return 'List deployment markers for a New Relic APM application. Requires the application entity GUID.';
    }

    public function parameters(): array
    {
        return [
            'application_guid' => ['type' => 'string', 'required' => true, 'description' => 'The entity GUID of the New Relic application.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('New Relic integration is not configured.');
            }

            if (empty($args['application_guid'])) {
                return ToolResult::error('The application_guid parameter is required.');
            }

            $result = $this->service->listDeployments($args['application_guid']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
