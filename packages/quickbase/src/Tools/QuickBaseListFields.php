<?php

namespace OpenCompany\Integrations\QuickBase\Tools;

/**
 * List fields in a Quickbase table.
 */
class QuickBaseListFields extends AbstractQuickBaseTool
{
    public const NAME = 'quickbase_list_fields';
    public const DESCRIPTION = 'List field definitions in a Quickbase table.';
    public const PARAMETERS = [
        'tableId' => ['type' => 'string', 'required' => true, 'description' => 'The table ID.'],
        'params' => ['type' => 'object', 'description' => 'Optional query parameters such as includeFieldPerms.'],
    ];

    /**
     * List fields.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listFields($this->requiredString($args, 'tableId', 'tableId'), $this->arrayArg($args, 'params'));
    }
}
