<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Fetches the Variance data generated for particular Company by transaction ID.
 *
 * Executes the official Avalara AvaTax REST API operation GetVarianceReportByCompanyCodeByTransactionId.
 */
class AvalaraGetVarianceReportByCompanyCodeByTransactionId extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_variance_report_by_company_code_by_transaction_id';
}