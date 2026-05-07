<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Link attributes to a customer.
 *
 * Executes the official Avalara AvaTax REST API operation LinkAttributesToCustomer.
 */
class AvalaraLinkAttributesToCustomer extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_link_attributes_to_customer';
}