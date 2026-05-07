<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Update a User Defined Field identified by id for a company.
 *
 * Executes the official Avalara AvaTax REST API operation UpdateUserDefinedField.
 */
class AvalaraUpdateUserDefinedField extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_update_user_defined_field';
}