<?php

namespace OpenCompany\Integrations\Copper\Tools;

/**
 * List Copper custom field definitions.
 */
class CopperListCustomFieldDefinitions extends AbstractCopperEndpointTool
{
    protected string $toolName = 'copper_list_custom_field_definitions';

    protected string $toolDescription = 'List Copper custom field definitions.';

    protected string $path = '/custom_field_definitions';
}
