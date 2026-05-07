<?php

namespace OpenCompany\Integrations\Apollo\Tools;

/**
 * View Apollo API usage and rate-limit statistics.
 */
class ApolloGetApiUsageStats extends AbstractApolloTool
{
    protected const NAME = 'apollo_get_api_usage_stats';

    protected const DESCRIPTION = 'View Apollo API usage and rate-limit statistics for the authenticated key.';

    protected const PARAMETERS = [];

    /**
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function callService(array $args): array
    {
        return $this->service->getApiUsageStats();
    }
}
