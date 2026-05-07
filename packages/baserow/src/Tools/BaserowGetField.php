<?php

namespace OpenCompany\Integrations\Baserow\Tools;

use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Get metadata for a single Baserow field.
 */
class BaserowGetField extends AbstractBaserowTool
{
    public function name(): string
    {
        return 'baserow_get_field';
    }

    public function description(): string
    {
        return 'Get metadata for a single Baserow field by field ID.';
    }

    public function parameters(): array
    {
        return [
            'field_id' => ['type' => 'integer', 'required' => true, 'description' => 'The Baserow field ID.'],
        ];
    }

    /**
     * Get a field definition.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        return $this->run(fn (): array => $this->service->getField($this->requiredInt($args, 'field_id')));
    }
}
