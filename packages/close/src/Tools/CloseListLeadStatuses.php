<?php

namespace OpenCompany\Integrations\Close\Tools;

/**
 * List lead statuses configured in Close.
 */
class CloseListLeadStatuses extends AbstractCloseEndpointTool
{
    protected string $toolName = 'close_list_lead_statuses';

    protected string $toolDescription = 'List lead statuses configured for the Close organization.';

    protected string $path = '/status/lead/';
}
