<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * List jurisdictions near a specific address.
 *
 * Executes the official Avalara AvaTax REST API operation ListJurisdictionsByAddress.
 */
class AvalaraListJurisdictionsByAddress extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_jurisdictions_by_address';
}