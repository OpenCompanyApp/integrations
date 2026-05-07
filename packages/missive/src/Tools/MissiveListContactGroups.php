<?php

namespace OpenCompany\Integrations\Missive\Tools;

/**
 * List Missive contact groups or organizations.
 */
class MissiveListContactGroups extends AbstractMissiveTool
{
    public const NAME = 'missive_list_contact_groups';
    public const DESCRIPTION = 'List Missive contact groups or organizations linked to a contact book.';
    public const PARAMETERS = [
        'params' => ['type' => 'object', 'description' => 'Query parameters including contact_book, kind, limit, and offset.'],
    ];

    /**
     * List contact groups.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listContactGroups($this->arrayArg($args, 'params'));
    }
}
