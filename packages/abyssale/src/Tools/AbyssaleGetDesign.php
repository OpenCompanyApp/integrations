<?php

namespace OpenCompany\Integrations\Abyssale\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve details for an Abyssale design.
 */
class AbyssaleGetDesign extends AbstractAbyssaleTool implements Tool
{
    public function name(): string
    {
        return 'abyssale_get_design';
    }

    public function description(): string
    {
        return 'Get an Abyssale design with its metadata, formats, and editable elements.';
    }

    public function parameters(): array
    {
        return [
            'design_id' => ['type' => 'string', 'required' => true, 'description' => 'The Abyssale design UUID.'],
        ];
    }

    /**
     * Execute the get design request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getDesign(
            $this->requiredString($args, 'design_id', 'Design ID'),
        ));
    }
}
