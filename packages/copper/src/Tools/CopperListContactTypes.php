<?php

namespace OpenCompany\Integrations\Copper\Tools;

/**
 * List Copper contact types.
 */
class CopperListContactTypes extends AbstractCopperEndpointTool
{
    protected string $toolName = 'copper_list_contact_types';

    protected string $toolDescription = 'List Copper contact types for people and companies.';

    protected string $path = '/contact_types';
}
