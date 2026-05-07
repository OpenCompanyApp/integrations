<?php

namespace OpenCompany\Integrations\Fellow\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a Fellow note by ID.
 *
 * Requires a privileged Fellow API key according to the official API docs.
 */
class FellowDeleteNote extends AbstractFellowTool implements Tool
{
    public function name(): string
    {
        return 'fellow_delete_note';
    }

    public function description(): string
    {
        return 'Delete a Fellow note by ID. This endpoint requires a privileged Fellow API key.';
    }

    public function parameters(): array
    {
        return [
            'note_id' => ['type' => 'string', 'required' => true, 'description' => 'Fellow note ID.'],
        ];
    }

    /**
     * Execute the delete note tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (note_id).
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->deleteNote($this->requiredString($args, 'note_id')));
    }
}
