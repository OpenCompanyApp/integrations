<?php

namespace OpenCompany\Integrations\QuickBase\Tools;

/**
 * Get a Quickbase field definition.
 */
class QuickBaseGetField extends AbstractQuickBaseTool
{
    public const NAME = 'quickbase_get_field';
    public const DESCRIPTION = 'Get a Quickbase field definition by field ID.';
    public const PARAMETERS = [
        'tableId' => ['type' => 'string', 'required' => true, 'description' => 'The table ID.'],
        'fieldId' => ['type' => 'integer', 'required' => true, 'description' => 'The field ID.'],
    ];

    /**
     * Get a field.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->getField($this->requiredString($args, 'tableId', 'tableId'), $this->requiredInt($args, 'fieldId', 'fieldId'));
    }
}
