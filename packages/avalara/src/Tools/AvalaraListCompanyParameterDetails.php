<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve parameters for a company.
 *
 * Executes the official Avalara AvaTax REST API operation ListCompanyParameterDetails.
 */
class AvalaraListCompanyParameterDetails extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_company_parameter_details';
}