<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Rejects linkage to a firm for a client account.
 *
 * Executes the official Avalara AvaTax REST API operation RejectFirmClientLinkage.
 */
class AvalaraRejectFirmClientLinkage extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_reject_firm_client_linkage';
}