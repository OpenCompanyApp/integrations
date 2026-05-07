<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve all State Reporting Codes based on filter..
 *
 * Executes the official Avalara AvaTax REST API operation QueryStateReportingCodes.
 */
class AvalaraQueryStateReportingCodes extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_query_state_reporting_codes';
}