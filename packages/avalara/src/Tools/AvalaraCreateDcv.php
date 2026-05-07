<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Create Domain control verification.
 *
 * Executes the official Avalara AvaTax REST API operation CreateDcv.
 */
class AvalaraCreateDcv extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_create_dcv';
}