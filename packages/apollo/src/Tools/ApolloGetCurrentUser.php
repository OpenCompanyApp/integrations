<?php

namespace OpenCompany\Integrations\Apollo\Tools;

/**
 * View the current Apollo API user when the endpoint is available.
 */
class ApolloGetCurrentUser extends AbstractApolloTool
{
    protected const NAME = 'apollo_get_current_user';

    protected const DESCRIPTION = 'Get the currently authenticated Apollo user profile when this endpoint is available for the API key.';

    protected const PARAMETERS = [];

    /**
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function callService(array $args): array
    {
        return $this->service->getCurrentUser();
    }
}
