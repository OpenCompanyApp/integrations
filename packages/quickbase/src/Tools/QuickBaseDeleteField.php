<?php

namespace OpenCompany\Integrations\QuickBase\Tools;

/**
 * Delete a Quickbase field.
 */
class QuickBaseDeleteField extends AbstractQuickBaseTool
{
    public const NAME = 'quickbase_delete_field';
    public const DESCRIPTION = 'Delete a field from a Quickbase table.';
    public const PARAMETERS = [
        'tableId' => ['type' => 'string', 'required' => true, 'description' => 'The table ID.'],
        'fieldId' => ['type' => 'integer', 'required' => true, 'description' => 'The field ID.'],
    ];

    /**
     * Delete a field.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->deleteField($this->requiredString($args, 'tableId', 'tableId'), $this->requiredInt($args, 'fieldId', 'fieldId'));
    }
}
