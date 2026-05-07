<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Approves linkage to a firm for a client account.
 *
 * Executes the official Avalara AvaTax REST API operation ApproveFirmClientLinkage.
 */
class AvalaraApproveFirmClientLinkage extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_approve_firm_client_linkage';
}