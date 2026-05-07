<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the full list of Avalara-supported usage of extra parameters for creating transactions..
 *
 * Executes the official Avalara AvaTax REST API operation ListParametersUsage.
 */
class AvalaraListParametersUsage extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_parameters_usage';
}