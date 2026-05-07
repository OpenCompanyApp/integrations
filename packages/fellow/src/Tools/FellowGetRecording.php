<?php

namespace OpenCompany\Integrations\Fellow\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve a Fellow recording by ID.
 */
class FellowGetRecording extends AbstractFellowTool implements Tool
{
    public function name(): string
    {
        return 'fellow_get_recording';
    }

    public function description(): string
    {
        return 'Retrieve a Fellow recording by ID.';
    }

    public function parameters(): array
    {
        return [
            'recording_id' => ['type' => 'string', 'required' => true, 'description' => 'Fellow recording ID.'],
        ];
    }

    /**
     * Execute the get recording tool.
     *
     * @param  array<string, mixed>  $args  Tool arguments (recording_id).
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getRecording($this->requiredString($args, 'recording_id')));
    }
}
