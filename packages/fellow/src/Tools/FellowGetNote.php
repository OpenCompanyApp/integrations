<?php

namespace OpenCompany\Integrations\Fellow\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Fellow note by ID.
 */
class FellowGetNote extends AbstractFellowTool implements Tool
{
    public function name(): string
    {
        return 'fellow_get_note';
    }

    public function description(): string
    {
        return 'Retrieve a Fellow note by ID.';
    }

    public function parameters(): array
    {
        return [
            'note_id' => ['type' => 'string', 'required' => true, 'description' => 'Fellow note ID.'],
        ];
    }

    /**
     * Execute the get note tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (note_id).
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getNote($this->requiredString($args, 'note_id')));
    }
}
