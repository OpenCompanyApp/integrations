<?php

namespace OpenCompany\Integrations\Tally\Tools;

use OpenCompany\Integrations\Tally\TallyService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get full details of a single Tally form submission by its ID.
 *
 * Returns the complete submission data including all field responses
 * and respondent metadata.
 */
class TallyGetSubmission implements Tool
{
    public function __construct(
        private TallyService $service,
    ) {}

    /**
     * Unique tool identifier.
     */
    public function name(): string
    {
        return 'tally_get_submission';
    }

    /**
     * Human-readable description of what this tool does.
     */
    public function description(): string
    {
        return 'Get full details of a single Tally form submission by its ID. Returns all field responses and respondent metadata.';
    }

    /**
     * Define the parameters this tool accepts.
     *
     * @return array<string, array{type: string, description?: string, required?: bool}>
     */
    public function parameters(): array
    {
        return [
            'submission_id' => ['type' => 'string', 'required' => true, 'description' => 'The Tally submission ID.'],
        ];
    }

    /**
     * Execute the get_submission tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Tally integration is not configured.');
            }

            $result = $this->service->getSubmission($args['submission_id']);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
