<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Update a company parameter.
 *
 * Executes the official Avalara AvaTax REST API operation UpdateCompanyParameterDetail.
 */
class AvalaraUpdateCompanyParameterDetail extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_update_company_parameter_detail';
}