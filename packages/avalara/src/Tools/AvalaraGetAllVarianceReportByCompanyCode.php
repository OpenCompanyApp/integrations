<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Fetches the Variance data generated for all the transactions done by Company..
 *
 * Executes the official Avalara AvaTax REST API operation GetAllVarianceReportByCompanyCode.
 */
class AvalaraGetAllVarianceReportByCompanyCode extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_all_variance_report_by_company_code';
}