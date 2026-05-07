<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Request a new entitilement to an existing customer.
 *
 * Executes the official Avalara AvaTax REST API operation RequestNewEntitlement.
 */
class AvalaraRequestNewEntitlement extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_request_new_entitlement';
}