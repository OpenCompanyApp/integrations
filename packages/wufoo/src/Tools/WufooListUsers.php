<?php

namespace OpenCompany\Integrations\Wufoo\Tools;

/**
 * List users in the configured Wufoo account.
 */
class WufooListUsers extends AbstractWufooTool
{
    public const NAME = 'wufoo_list_users';
    public const DESCRIPTION = 'List Wufoo account users visible to the API key.';
    public const PARAMETERS = [
        'params' => ['type' => 'object', 'description' => 'Optional query parameters such as pretty.'],
    ];

    /**
     * List account users.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function call(array $args): array
    {
        return $this->service->listUsers($this->arrayArg($args, 'params'));
    }
}
