<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Unlink attributes from a customer.
 *
 * Executes the official Avalara AvaTax REST API operation UnlinkAttributesFromCustomer.
 */
class AvalaraUnlinkAttributesFromCustomer extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_unlink_attributes_from_customer';
}