<?php

namespace OpenCompany\Integrations\Copper\Tools;

/**
 * Fetch Copper account details.
 */
class CopperGetAccountDetails extends AbstractCopperEndpointTool
{
    protected string $toolName = 'copper_get_account_details';

    protected string $toolDescription = 'Fetch account details for the authenticated Copper account.';

    protected string $path = '/account';
}
