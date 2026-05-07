<?php

namespace OpenCompany\Integrations\Missive\Tools;

/**
 * List Missive canned responses.
 */
class MissiveListResponses extends AbstractMissiveTool
{
    public const NAME = 'missive_list_responses';
    public const DESCRIPTION = 'List Missive canned responses for the authenticated user.';
    public const PARAMETERS = [
        'params' => ['type' => 'object', 'description' => 'Query parameters such as organization, limit, and offset.'],
    ];

    /**
     * List responses.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listResponses($this->arrayArg($args, 'params'));
    }
}
