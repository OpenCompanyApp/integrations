<?php

namespace OpenCompany\Integrations\SurveyMonkey\Tools;

use OpenCompany\Integrations\SurveyMonkey\SurveyMonkeyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

class SurveyMonkeyGetResponse implements Tool
{
    public function __construct(
        private SurveyMonkeyService $service,
    ) {}

    public function name(): string
    {
        return 'surveymonkey_get_response';
    }

    public function description(): string
    {
        return 'Get a single response for a SurveyMonkey survey by response ID, including all answers and metadata.';
    }

    public function parameters(): array
    {
        return [
            'survey_id' => ['type' => 'string', 'required' => true, 'description' => 'The survey ID.'],
            'response_id' => ['type' => 'string', 'required' => true, 'description' => 'The response ID.'],
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

            if (empty($args['response_id'])) {
                return ToolResult::error('response_id is required.');
            }

            $result = $this->service->getResponse($args['survey_id'], $args['response_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
