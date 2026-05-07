<?php

namespace OpenCompany\Integrations\Close\Tools;

/**
 * List opportunity statuses configured in Close.
 */
class CloseListOpportunityStatuses extends AbstractCloseEndpointTool
{
    protected string $toolName = 'close_list_opportunity_statuses';

    protected string $toolDescription = 'List opportunity statuses configured for the Close organization.';

    protected string $path = '/status/opportunity/';
}
