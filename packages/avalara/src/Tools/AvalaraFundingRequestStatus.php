<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve status about a funding setup request.
 *
 * Executes the official Avalara AvaTax REST API operation FundingRequestStatus.
 */
class AvalaraFundingRequestStatus extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_funding_request_status';
}