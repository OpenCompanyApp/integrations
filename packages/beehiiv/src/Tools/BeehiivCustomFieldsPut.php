<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Update custom field OAuth Scope: custom_fields:write.
 *
 * Executes the official beehiiv API operation customFields_put.
 */
class BeehiivCustomFieldsPut extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_custom_fields_put';
}
