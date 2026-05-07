<?php

namespace OpenCompany\Integrations\Copper\Tools;

/**
 * List Copper lead statuses.
 */
class CopperListLeadStatuses extends AbstractCopperEndpointTool
{
    protected string $toolName = 'copper_list_lead_statuses';

    protected string $toolDescription = 'List configured Copper lead statuses.';

    protected string $path = '/lead_statuses';
}
