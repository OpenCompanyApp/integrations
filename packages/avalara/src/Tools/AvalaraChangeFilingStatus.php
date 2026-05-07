<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Change the filing status of this company.
 *
 * Executes the official Avalara AvaTax REST API operation ChangeFilingStatus.
 */
class AvalaraChangeFilingStatus extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_change_filing_status';
}