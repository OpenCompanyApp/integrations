<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Delete a User Defined Field by User Defined Field id for a company..
 *
 * Executes the official Avalara AvaTax REST API operation DeleteUserDefinedField.
 */
class AvalaraDeleteUserDefinedField extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_delete_user_defined_field';
}