<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieves a list of location records associated with the specified account. This endpoint is secured and requires appropriate subscription and permission levels..
 *
 * Executes the official Avalara AvaTax REST API operation ListLocationByAccount.
 */
class AvalaraListLocationByAccount extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_location_by_account';
}