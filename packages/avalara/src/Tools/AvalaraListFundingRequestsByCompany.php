<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Check managed returns funding status for a company.
 *
 * Executes the official Avalara AvaTax REST API operation ListFundingRequestsByCompany.
 */
class AvalaraListFundingRequestsByCompany extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_funding_requests_by_company';
}