<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Request managed returns funding setup for a company.
 *
 * Executes the official Avalara AvaTax REST API operation CreateFundingRequest.
 */
class AvalaraCreateFundingRequest extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_create_funding_request';
}