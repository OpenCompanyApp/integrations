<?php

namespace OpenCompany\Integrations\Fellow\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Delete a Fellow recording by ID.
 *
 * Requires a privileged Fellow API key according to the official API docs.
 */
class FellowDeleteRecording extends AbstractFellowTool implements Tool
{
    public function name(): string
    {
        return 'fellow_delete_recording';
    }

    public function description(): string
    {
        return 'Delete a Fellow recording by ID. This endpoint requires a privileged Fellow API key.';
    }

    public function parameters(): array
    {
        return [
            'recording_id' => ['type' => 'string', 'required' => true, 'description' => 'Fellow recording ID.'],
        ];
    }

    /**
     * Execute the delete recording tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (recording_id).
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->deleteRecording($this->requiredString($args, 'recording_id')));
    }
}
