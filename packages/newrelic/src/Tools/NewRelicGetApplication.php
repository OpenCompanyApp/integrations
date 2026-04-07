<?php

namespace OpenCompany\Integrations\NewRelic\Tools;

use OpenCompany\Integrations\NewRelic\NewRelicService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class NewRelicGetApplication implements Tool
{
    public function __construct(
        private NewRelicService $service,
    ) {}

    public function name(): string
    {
        return 'newrelic_get_application';
    }

    public function description(): string
    {
        return 'Get details of a specific New Relic APM application by its application ID, including language, health status, and Apdex thresholds.';
    }

    public function parameters(): array
    {
        return [
            'application_id' => ['type' => 'integer', 'required' => true, 'description' => 'The New Relic application ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('New Relic integration is not configured.');
            }

            if (empty($args['application_id'])) {
                return ToolResult::error('The application_id parameter is required.');
            }

            $result = $this->service->getApplication((int) $args['application_id']);

            if (empty($result)) {
                return ToolResult::error('Application not found.');
            }

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
