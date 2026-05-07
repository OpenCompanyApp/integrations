<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve a customer's attributes.
 *
 * Executes the official Avalara AvaTax REST API operation ListAttributesForCustomer.
 */
class AvalaraListAttributesForCustomer extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_attributes_for_customer';
}