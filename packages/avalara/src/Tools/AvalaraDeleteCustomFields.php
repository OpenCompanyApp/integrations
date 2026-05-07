<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Delete custom fields.
 *
 * Executes the official Avalara AvaTax REST API operation DeleteCustomFields.
 */
class AvalaraDeleteCustomFields extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_delete_custom_fields';
}