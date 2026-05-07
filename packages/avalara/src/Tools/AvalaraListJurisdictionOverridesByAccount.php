<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve overrides for this account.
 *
 * Executes the official Avalara AvaTax REST API operation ListJurisdictionOverridesByAccount.
 */
class AvalaraListJurisdictionOverridesByAccount extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_jurisdiction_overrides_by_account';
}