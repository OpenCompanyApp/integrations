<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Revokes previously approved linkage to a firm for a client account.
 *
 * Executes the official Avalara AvaTax REST API operation RevokeFirmClientLinkage.
 */
class AvalaraRevokeFirmClientLinkage extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_revoke_firm_client_linkage';
}