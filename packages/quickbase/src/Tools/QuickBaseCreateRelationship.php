<?php

namespace OpenCompany\Integrations\QuickBase\Tools;

/**
 * Create a Quickbase table relationship.
 */
class QuickBaseCreateRelationship extends AbstractQuickBaseTool
{
    public const NAME = 'quickbase_create_relationship';
    public const DESCRIPTION = 'Create a relationship for a Quickbase table.';
    public const PARAMETERS = [
        'tableId' => ['type' => 'string', 'required' => true, 'description' => 'The parent table ID.'],
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Relationship creation payload.'],
    ];

    /**
     * Create relationship.
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

        return $this->service->createRelationship($this->requiredString($args, 'tableId', 'tableId'), $body);
    }
}
