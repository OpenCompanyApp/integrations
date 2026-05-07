<?php

namespace OpenCompany\Integrations\Tally\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Replace the block tree for a Tally form.
 */
class TallyUpdateBlocks extends AbstractTallyTool implements Tool
{
    public function name(): string
    {
        return 'tally_update_blocks';
    }

    public function description(): string
    {
        return 'Replace the block tree for a Tally form.';
    }

    public function parameters(): array
    {
        return [
            'form_id' => ['type' => 'string', 'required' => true, 'description' => 'The Tally form ID.'],
            'blocks' => ['type' => 'array', 'required' => true, 'description' => 'Full replacement block array.', 'items' => ['type' => 'object']],
        ];
    }

    /**
     * Execute the update blocks request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->updateBlocks(
            $this->requiredString($args, 'form_id', 'Form ID'),
            is_array($args['blocks'] ?? null) ? $args['blocks'] : throw new \InvalidArgumentException('Blocks are required.'),
        ));
    }
}
