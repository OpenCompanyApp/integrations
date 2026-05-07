<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Create vendors for this company.
 *
 * Executes the official Avalara AvaTax REST API operation CreateVendors.
 */
class AvalaraCreateVendors extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_create_vendors';
}