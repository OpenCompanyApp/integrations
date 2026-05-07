<?php

namespace OpenCompany\Integrations\Tally\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * List the block tree for a Tally form.
 */
class TallyListBlocks extends AbstractTallyTool implements Tool
{
    public function name(): string
    {
        return 'tally_list_blocks';
    }

    public function description(): string
    {
        return 'List blocks for a Tally form.';
    }

    public function parameters(): array
    {
        return [
            'form_id' => ['type' => 'string', 'required' => true, 'description' => 'The Tally form ID.'],
        ];
    }

    /**
     * Execute the list blocks request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->listBlocks(
            $this->requiredString($args, 'form_id', 'Form ID'),
        ));
    }
}
