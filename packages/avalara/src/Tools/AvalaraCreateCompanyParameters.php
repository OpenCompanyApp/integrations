<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Add parameters to a company..
 *
 * Executes the official Avalara AvaTax REST API operation CreateCompanyParameters.
 */
class AvalaraCreateCompanyParameters extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_create_company_parameters';
}