<?php

namespace OpenCompany\Integrations\Formstack\Tools;

use OpenCompany\Integrations\Formstack\FormstackService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * FormstackDeleteSubmission — Delete a Formstack submission.
 *
 * Permanently removes a submission and its data from Formstack.
 * This action cannot be undone.
 *
 * @see https://www.formstack.com/docs/api/v2/submission#delete-a-submission
 */
class FormstackDeleteSubmission implements Tool
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
        return 'formstack_delete_submission';
    }

    /**
     * Human-readable description of what the tool does.
     */
    public function description(): string
    {
        return 'Delete a Formstack submission. This action is permanent and cannot be undone.';
    }

    /**
     * Parameter schema for the tool.
     *
     * @return array<string, array<string, mixed>>
     */
    public function parameters(): array
    {
        return [
            'submission_id' => ['type' => 'integer', 'required' => true, 'description' => 'The numeric ID of the submission to delete.'],
        ];
    }

    /**
     * Execute the tool — delete a submission from Formstack.
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
            $this->service->deleteSubmission($submissionId);

            return ToolResult::success("Submission {$submissionId} has been deleted.");
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
