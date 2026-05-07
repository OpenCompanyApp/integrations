<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the full list of Avalara-supported usage of parameters used for returns..
 *
 * Executes the official Avalara AvaTax REST API operation ListReturnsParametersUsage.
 */
class AvalaraListReturnsParametersUsage extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_returns_parameters_usage';
}