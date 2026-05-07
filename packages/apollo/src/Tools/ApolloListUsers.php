<?php

namespace OpenCompany\Integrations\Apollo\Tools;

/**
 * List Apollo team users.
 */
class ApolloListUsers extends AbstractApolloTool
{
    protected const NAME = 'apollo_list_users';

    protected const DESCRIPTION = 'List users in the Apollo team. User IDs are needed for account ownership and related workflows.';

    protected const PARAMETERS = [];

    /**
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function callService(array $args): array
    {
        return $this->service->listUsers();
    }
}
