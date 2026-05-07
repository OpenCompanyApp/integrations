<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Delete custom field OAuth Scope: custom_fields:write.
 *
 * Executes the official beehiiv API operation customFields_delete.
 */
class BeehiivCustomFieldsDelete extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_custom_fields_delete';
}
