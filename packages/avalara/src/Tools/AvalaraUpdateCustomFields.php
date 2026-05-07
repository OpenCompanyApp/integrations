<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Update custom fields.
 *
 * Executes the official Avalara AvaTax REST API operation UpdateCustomFields.
 */
class AvalaraUpdateCustomFields extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_update_custom_fields';
}