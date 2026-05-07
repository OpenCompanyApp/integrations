<?php

namespace OpenCompany\Integrations\Copper\Tools;

/**
 * List Copper customer sources.
 */
class CopperListCustomerSources extends AbstractCopperEndpointTool
{
    protected string $toolName = 'copper_list_customer_sources';

    protected string $toolDescription = 'List Copper customer sources used by leads and opportunities.';

    protected string $path = '/customer_sources';
}
