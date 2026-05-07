<?php

namespace OpenCompany\Integrations\Tally\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List questions configured on a Tally form.
 */
class TallyListQuestions extends AbstractTallyTool implements Tool
{
    public function name(): string
    {
        return 'tally_list_questions';
    }

    public function description(): string
    {
        return 'List questions for a Tally form.';
    }

    public function parameters(): array
    {
        return [
            'form_id' => ['type' => 'string', 'required' => true, 'description' => 'The Tally form ID.'],
        ];
    }

    /**
     * Execute the list questions request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->listQuestions(
            $this->requiredString($args, 'form_id', 'Form ID'),
        ));
    }
}
