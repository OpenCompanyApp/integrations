<?php

namespace OpenCompany\Integrations\Missive\Tools;

/**
 * List Missive contact books.
 */
class MissiveListContactBooks extends AbstractMissiveTool
{
    public const NAME = 'missive_list_contact_books';
    public const DESCRIPTION = 'List Missive contact books accessible to the API token user.';
    public const PARAMETERS = [
        'params' => ['type' => 'object', 'description' => 'Query parameters such as limit and offset.'],
    ];

    /**
     * List contact books.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listContactBooks($this->arrayArg($args, 'params'));
    }
}
