<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Lists the next level of HS Codes given a destination country and HS Code prefix..
 *
 * Executes the official Avalara AvaTax REST API operation ListCrossBorderCodes.
 */
class AvalaraListCrossBorderCodes extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_cross_border_codes';
}