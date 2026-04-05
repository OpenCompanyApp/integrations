<?php

namespace OpenCompany\Integrations\Formstack\Tools;

use OpenCompany\Integrations\Formstack\FormstackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * FormstackGetSubmission — Retrieve details of a specific Formstack submission.
 *
 * Returns the full submission data including all field values,
 * timestamps, and metadata. Use this to inspect a single form entry.
 *
 * @see https://www.formstack.com/docs/api/v2/submission#get-a-specific-submission
 */
class FormstackGetSubmission implements Tool
{
    /**
     * @param  FormstackService  $service  The Formstack API service instance.
     */
    public function __construct(
        private FormstackService $service,
    ) {}

    /**
     * Machine name of the tool.
     */
    public function name(): string
    {
        return 'formstack_get_submission';
    }

    /**
     * Human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'Get details of a specific Formstack submission. Returns all field values, timestamps, and metadata.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'submission_id' => ['type' => 'integer', 'required' => true, 'description' => 'The numeric ID of the submission to retrieve.'],
        ];
    }

    /**
     * Execute the tool — get submission details from Formstack.
     *
     * @param  array{submission_id: int}  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Formstack integration is not configured.');
            }

            $submissionId = (int) $args['submission_id'];
            $result = $this->service->getSubmission($submissionId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
