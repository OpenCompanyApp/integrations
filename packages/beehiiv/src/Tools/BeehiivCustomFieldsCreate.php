<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Create custom field OAuth Scope: custom_fields:write.
 *
 * Executes the official beehiiv API operation customFields_create.
 */
class BeehiivCustomFieldsCreate extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_custom_fields_create';
}
