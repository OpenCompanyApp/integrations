<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve a single vendor.
 *
 * Executes the official Avalara AvaTax REST API operation GetVendor.
 */
class AvalaraGetVendor extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_vendor';
}