<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * Get custom field OAuth Scope: custom_fields:read.
 *
 * Executes the official beehiiv API operation customFields_show.
 */
class BeehiivCustomFieldsShow extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_custom_fields_show';
}
