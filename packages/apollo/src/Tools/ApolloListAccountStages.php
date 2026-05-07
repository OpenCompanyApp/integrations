<?php

namespace OpenCompany\Integrations\Apollo\Tools;

/**
 * List Apollo account stages.
 */
class ApolloListAccountStages extends AbstractApolloTool
{
    protected const NAME = 'apollo_list_account_stages';

    protected const DESCRIPTION = 'List Apollo account stages and IDs for account create/update workflows.';

    protected const PARAMETERS = [];

    /**
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function callService(array $args): array
    {
        return $this->service->listAccountStages();
    }
}
