<?php

namespace OpenCompany\Integrations\QuickBase\Tools;

/**
 * Delete a Quickbase table relationship.
 */
class QuickBaseDeleteRelationship extends AbstractQuickBaseTool
{
    public const NAME = 'quickbase_delete_relationship';
    public const DESCRIPTION = 'Delete a Quickbase table relationship.';
    public const PARAMETERS = [
        'tableId' => ['type' => 'string', 'required' => true, 'description' => 'The table ID.'],
        'relationshipId' => ['type' => 'integer', 'required' => true, 'description' => 'The relationship ID.'],
    ];

    /**
     * Delete relationship.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->deleteRelationship($this->requiredString($args, 'tableId', 'tableId'), $this->requiredInt($args, 'relationshipId', 'relationshipId'));
    }
}
