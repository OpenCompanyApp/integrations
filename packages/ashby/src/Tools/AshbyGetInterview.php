<?php

namespace OpenCompany\Integrations\Ashby\Tools;

use OpenCompany\Integrations\Ashby\AshbyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get a single interview from Ashby ATS.
 *
 * Retrieves full interview details including scheduled time,
 * interviewers, feedback, and associated application data.
 */
class AshbyGetInterview implements Tool
{
    public function __construct(
        private AshbyService $service,
    ) {}

    public function name(): string
    {
        return 'ashby_get_interview';
    }

    public function description(): string
    {
        return 'Get detailed information about a specific interview in Ashby, including scheduled time, interviewers, feedback, and scorecards.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'The interview ID.'],
        ];
    }

    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Ashby integration is not configured.');
            }

            if (empty($args['id'])) {
                return ToolResult::error('Interview ID is required.');
            }

            $result = $this->service->getInterview($args['id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
