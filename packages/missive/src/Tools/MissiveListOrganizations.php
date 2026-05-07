<?php

namespace OpenCompany\Integrations\Missive\Tools;

/**
 * List Missive organizations.
 */
class MissiveListOrganizations extends AbstractMissiveTool
{
    public const NAME = 'missive_list_organizations';
    public const DESCRIPTION = 'List organizations the authenticated Missive user is part of.';
    public const PARAMETERS = [
        'params' => ['type' => 'object', 'description' => 'Query parameters such as limit and offset.'],
    ];

    /**
     * List organizations.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listOrganizations($this->arrayArg($args, 'params'));
    }
}
