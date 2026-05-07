<?php

namespace OpenCompany\Integrations\Abyssale\Tools;

use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Retrieve details for a specific Abyssale design format.
 */
class AbyssaleGetDesignFormat extends AbstractAbyssaleTool implements Tool
{
    public function name(): string
    {
        return 'abyssale_get_design_format';
    }

    public function description(): string
    {
        return 'Get details for a specific format inside an Abyssale design.';
    }

    public function parameters(): array
    {
        return [
            'design_id' => ['type' => 'string', 'required' => true, 'description' => 'The Abyssale design UUID.'],
            'format_specifier' => ['type' => 'string', 'required' => true, 'description' => 'The format ID or format name.'],
        ];
    }

    /**
     * Execute the get design format request.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getDesignFormat(
            $this->requiredString($args, 'design_id', 'Design ID'),
            $this->requiredString($args, 'format_specifier', 'Format specifier'),
        ));
    }
}
