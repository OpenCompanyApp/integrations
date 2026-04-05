<?php

namespace OpenCompany\Integrations\SurveyMonkey\Tools;

use OpenCompany\Integrations\SurveyMonkey\SurveyMonkeyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SurveyMonkeyListCollectors implements Tool
{
    public function __construct(
        private SurveyMonkeyService $service,
    ) {}

    public function name(): string
    {
        return 'surveymonkey_list_collectors';
    }

    public function description(): string
    {
        return 'List all collectors for a SurveyMonkey survey. Collectors are distribution channels (e.g., weblink, email).';
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

            $result = $this->service->listCollectors($args['survey_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
