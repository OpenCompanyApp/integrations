<?php

namespace OpenCompany\Integrations\Tally\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Tally\TallyService;

/**
 * Get details of a specific Tally form submission by its ID.
 */
class TallyGetSubmission implements Tool
{
    /**
     * @param  TallyService  $service  The Tally API service instance.
     */
    public function __construct(
        private TallyService $service,
    ) {}

    public function name(): string
    {
        return 'tally_get_submission';
    }

    public function description(): string
    {
        return 'Get full details of a specific form submission by its ID, including all field responses and metadata.';
    }

    public function parameters(): array
    {
        return [
            'submission_id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The Tally submission ID.',
            ],
        ];
    }

    /**
     * Execute the get submission request.
     *
     * @param  array<string, mixed>  $args  Tool arguments (submission_id).
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Tally integration is not configured.');
            }

            $submissionId = $args['submission_id'] ?? '';
            if (empty($submissionId)) {
                return ToolResult::error('Submission ID is required.');
            }

            $result = $this->service->getSubmission($submissionId);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
