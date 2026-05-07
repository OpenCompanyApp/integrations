<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve a single company parameter.
 *
 * Executes the official Avalara AvaTax REST API operation GetCompanyParameterDetail.
 */
class AvalaraGetCompanyParameterDetail extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_company_parameter_detail';
}