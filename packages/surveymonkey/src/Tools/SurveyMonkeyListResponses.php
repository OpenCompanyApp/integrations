<?php

namespace OpenCompany\Integrations\SurveyMonkey\Tools;

use OpenCompany\Integrations\SurveyMonkey\SurveyMonkeyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SurveyMonkeyListResponses implements Tool
{
    public function __construct(
        private SurveyMonkeyService $service,
    ) {}

    public function name(): string
    {
        return 'surveymonkey_list_responses';
    }

    public function description(): string
    {
        return 'List all bulk responses for a SurveyMonkey survey. Returns response IDs, timestamps, and answer data.';
    }

    public function parameters(): array
    {
        return [
            'survey_id' => ['type' => 'string', 'required' => true, 'description' => 'The survey ID.'],
            'page' => ['type' => 'integer', 'description' => 'Page number for pagination (default: 1).'],
            'per_page' => ['type' => 'integer', 'description' => 'Number of responses per page (default: 50, max: 100).'],
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

            $page = isset($args['page']) ? (int) $args['page'] : 1;
            $perPage = isset($args['per_page']) ? (int) $args['per_page'] : 50;

            $result = $this->service->listResponses($args['survey_id'], $page, $perPage);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
