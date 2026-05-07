<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the full list of Avalara-supported postal codes..
 *
 * Executes the official Avalara AvaTax REST API operation ListPostalCodes.
 */
class AvalaraListPostalCodes extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_postal_codes';
}