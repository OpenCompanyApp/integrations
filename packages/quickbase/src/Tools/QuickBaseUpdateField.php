<?php

namespace OpenCompany\Integrations\QuickBase\Tools;

/**
 * Update a Quickbase field.
 */
class QuickBaseUpdateField extends AbstractQuickBaseTool
{
    public const NAME = 'quickbase_update_field';
    public const DESCRIPTION = 'Update field properties in a Quickbase table.';
    public const PARAMETERS = [
        'tableId' => ['type' => 'string', 'required' => true, 'description' => 'The table ID.'],
        'fieldId' => ['type' => 'integer', 'required' => true, 'description' => 'The field ID.'],
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Field attributes to update.'],
    ];

    /**
     * Update a field.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        $body = $this->arrayArg($args, 'body');
        if ($body === []) {
            throw new \InvalidArgumentException('body is required.');
        }

        return $this->service->updateField($this->requiredString($args, 'tableId', 'tableId'), $this->requiredInt($args, 'fieldId', 'fieldId'), $body);
    }
}
