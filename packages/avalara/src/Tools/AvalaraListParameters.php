<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the full list of Avalara-supported extra parameters for creating transactions..
 *
 * Executes the official Avalara AvaTax REST API operation ListParameters.
 */
class AvalaraListParameters extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_parameters';
}