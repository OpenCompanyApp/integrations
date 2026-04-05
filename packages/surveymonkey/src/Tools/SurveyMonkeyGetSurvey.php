<?php

namespace OpenCompany\Integrations\SurveyMonkey\Tools;

use OpenCompany\Integrations\SurveyMonkey\SurveyMonkeyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SurveyMonkeyGetSurvey implements Tool
{
    public function __construct(
        private SurveyMonkeyService $service,
    ) {}

    public function name(): string
    {
        return 'surveymonkey_get_survey';
    }

    public function description(): string
    {
        return 'Get details of a specific SurveyMonkey survey by ID, including title, language, and question count.';
    }

    public function parameters(): array
    {
        return [
            'survey_id' => ['type' => 'string', 'required' => true, 'description' => 'The survey ID.'],
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

            $result = $this->service->getSurvey($args['survey_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
