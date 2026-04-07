<?php

namespace OpenCompany\Integrations\Gainsight\Tools;

use OpenCompany\Integrations\Gainsight\GainsightService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Tool for retrieving detailed information about a specific Gainsight survey.
 *
 * Fetches full survey metadata including questions, response statistics,
 * distribution settings, and associated companies.
 */
class GainsightGetSurvey implements Tool
{
    /**
     * Create a new GainsightGetSurvey tool instance.
     */
    public function __construct(
        private GainsightService $service,
    ) {}

    /**
     * Get the tool name identifier.
     */
    public function name(): string
    {
        return 'gainsight_get_survey';
    }

    /**
     * Get the tool description for AI agent consumption.
     */
    public function description(): string
    {
        return 'Get detailed information about a specific survey in Gainsight, including questions, response statistics, and distribution settings.';
    }

    /**
     * Get the tool parameter schema.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'surveyId' => ['type' => 'string', 'required' => true, 'description' => 'The unique survey identifier (Gainsight Survey ID).'],
        ];
    }

    /**
     * Execute the get survey tool.
     *
     * @param  array  $args  Tool arguments containing the surveyId.
     * @return ToolResult The result containing survey details or an error message.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Gainsight integration is not configured.');
            }

            $result = $this->service->getSurvey($args['surveyId']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
