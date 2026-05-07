<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the list of Avalara-supported parameters based on account subscriptions..
 *
 * Executes the official Avalara AvaTax REST API operation ListParametersByAccount.
 */
class AvalaraListParametersByAccount extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_parameters_by_account';
}