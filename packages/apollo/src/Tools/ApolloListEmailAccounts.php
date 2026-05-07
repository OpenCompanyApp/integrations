<?php

namespace OpenCompany\Integrations\Apollo\Tools;

/**
 * List Apollo email accounts.
 */
class ApolloListEmailAccounts extends AbstractApolloTool
{
    protected const NAME = 'apollo_list_email_accounts';

    protected const DESCRIPTION = 'List email accounts available in the Apollo team.';

    protected const PARAMETERS = [];

    /**
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function callService(array $args): array
    {
        return $this->service->listEmailAccounts();
    }
}
