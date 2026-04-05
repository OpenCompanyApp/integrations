<?php

namespace OpenCompany\Integrations\SurveyMonkey\Tools;

use OpenCompany\Integrations\SurveyMonkey\SurveyMonkeyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SurveyMonkeyCreateCollector implements Tool
{
    public function __construct(
        private SurveyMonkeyService $service,
    ) {}

    public function name(): string
    {
        return 'surveymonkey_create_collector';
    }

    public function description(): string
    {
        return 'Create a collector for a SurveyMonkey survey to distribute it. Collector types include "weblink" (shareable URL) and "email" (email invitation).';
    }

    public function parameters(): array
    {
        return [
            'survey_id' => ['type' => 'string', 'required' => true, 'description' => 'The survey ID.'],
            'type' => ['type' => 'string', 'required' => true, 'description' => 'Collector type: "weblink" or "email".'],
            'name' => ['type' => 'string', 'description' => 'A display name for the collector.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('SurveyMonkey integration is not configured.');
            }

            if (empty($args['survey_id'])) {
                return ToolResult::error('survey_id is required.');
            }

            if (empty($args['type'])) {
                return ToolResult::error('type is required. Use "weblink" or "email".');
            }

            $result = $this->service->createCollector(
                $args['survey_id'],
                $args['type'],
                $args['name'] ?? null,
            );

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
