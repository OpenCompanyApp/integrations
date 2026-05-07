<?php

namespace OpenCompany\Integrations\Tally\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get details of a specific Tally form submission by its ID.
 */
class TallyGetSubmission extends AbstractTallyTool implements Tool
{
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
            'form_id' => [
                'type' => 'string',
                'required' => true,
                'description' => 'The Tally form ID that owns the submission.',
            ],
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
     * @param  array<string, mixed>  $args  Tool arguments (form_id, submission_id).
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getSubmission(
            $this->requiredString($args, 'form_id', 'Form ID'),
            $this->requiredString($args, 'submission_id', 'Submission ID'),
        ));
    }
}
