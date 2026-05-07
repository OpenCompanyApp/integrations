<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Request the javascript for a funding setup widget.
 *
 * Executes the official Avalara AvaTax REST API operation ActivateFundingRequest.
 */
class AvalaraActivateFundingRequest extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_activate_funding_request';
}