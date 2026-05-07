<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Get this company's filing status.
 *
 * Executes the official Avalara AvaTax REST API operation GetFilingStatus.
 */
class AvalaraGetFilingStatus extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_filing_status';
}