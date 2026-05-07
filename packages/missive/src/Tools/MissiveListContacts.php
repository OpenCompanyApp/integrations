<?php

namespace OpenCompany\Integrations\Missive\Tools;

/**
 * List Missive contacts.
 */
class MissiveListContacts extends AbstractMissiveTool
{
    public const NAME = 'missive_list_contacts';
    public const DESCRIPTION = 'List Missive contacts with contact book, search, pagination, and sync filters.';
    public const PARAMETERS = [
        'params' => ['type' => 'object', 'description' => 'Query parameters such as contact_book, search, modified_since, include_deleted, limit, and offset.'],
    ];

    /**
     * List contacts.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listContacts($this->arrayArg($args, 'params'));
    }
}
