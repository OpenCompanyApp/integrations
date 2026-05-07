<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Lists all parents of an HS Code..
 *
 * Executes the official Avalara AvaTax REST API operation GetCrossBorderCode.
 */
class AvalaraGetCrossBorderCode extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_cross_border_code';
}