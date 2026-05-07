<?php

namespace OpenCompany\Integrations\Tally\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Update a Tally question title.
 */
class TallyUpdateQuestion extends AbstractTallyTool implements Tool
{
    public function name(): string
    {
        return 'tally_update_question';
    }

    public function description(): string
    {
        return 'Update a Tally question title by form and question ID.';
    }

    public function parameters(): array
    {
        return [
            'form_id' => ['type' => 'string', 'required' => true, 'description' => 'The Tally form ID.'],
            'question_id' => ['type' => 'string', 'required' => true, 'description' => 'The Tally question ID.'],
            'title' => ['type' => 'string', 'required' => true, 'description' => 'New question title.'],
        ];
    }

    /**
     * Execute the update question request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->updateQuestion(
            $this->requiredString($args, 'form_id', 'Form ID'),
            $this->requiredString($args, 'question_id', 'Question ID'),
            $this->requiredString($args, 'title', 'Title'),
        ));
    }
}
