<?php

namespace OpenCompany\Integrations\Copper\Tools;

/**
 * List Copper activity types.
 */
class CopperListActivityTypes extends AbstractCopperEndpointTool
{
    protected string $toolName = 'copper_list_activity_types';

    protected string $toolDescription = 'List Copper activity types.';

    protected string $path = '/activity_types';
}
