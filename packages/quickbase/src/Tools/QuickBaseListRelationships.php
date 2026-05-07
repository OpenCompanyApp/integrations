<?php

namespace OpenCompany\Integrations\QuickBase\Tools;

/**
 * List relationships for a Quickbase table.
 */
class QuickBaseListRelationships extends AbstractQuickBaseTool
{
    public const NAME = 'quickbase_list_relationships';
    public const DESCRIPTION = 'List relationships for a Quickbase table.';
    public const PARAMETERS = [
        'tableId' => ['type' => 'string', 'required' => true, 'description' => 'The table ID.'],
    ];

    /**
     * List relationships.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listRelationships($this->requiredString($args, 'tableId', 'tableId'));
    }
}
