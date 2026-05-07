<?php

namespace OpenCompany\Integrations\Beehiiv\Tools;

/**
 * List custom fields OAuth Scope: custom_fields:read.
 *
 * Executes the official beehiiv API operation customFields_index.
 */
class BeehiivCustomFieldsIndex extends AbstractBeehiivOperationTool
{
    protected const OPERATION = 'beehiiv_custom_fields_index';
}
