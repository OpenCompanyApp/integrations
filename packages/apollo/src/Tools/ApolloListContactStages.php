<?php

namespace OpenCompany\Integrations\Apollo\Tools;

/**
 * List contact stages from Apollo.
 */
class ApolloListContactStages extends AbstractApolloTool
{
    protected const NAME = 'apollo_list_contact_stages';

    protected const DESCRIPTION = 'List Apollo contact stages and IDs for contact create/update workflows.';

    protected const PARAMETERS = [];

    /**
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function callService(array $args): array
    {
        return $this->service->listContactStages();
    }
}
