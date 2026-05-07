<?php

namespace OpenCompany\Integrations\Tally\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a Tally submission from a specific form.
 */
class TallyDeleteSubmission extends AbstractTallyTool implements Tool
{
    public function name(): string
    {
        return 'tally_delete_submission';
    }

    public function description(): string
    {
        return 'Delete a Tally submission by form ID and submission ID.';
    }

    public function parameters(): array
    {
        return [
            'form_id' => ['type' => 'string', 'required' => true, 'description' => 'The Tally form ID.'],
            'submission_id' => ['type' => 'string', 'required' => true, 'description' => 'The Tally submission ID.'],
        ];
    }

    /**
     * Execute the delete submission request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->deleteSubmission(
            $this->requiredString($args, 'form_id', 'Form ID'),
            $this->requiredString($args, 'submission_id', 'Submission ID'),
        ));
    }
}
