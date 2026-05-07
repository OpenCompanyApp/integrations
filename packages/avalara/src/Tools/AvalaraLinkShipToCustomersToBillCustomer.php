<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Link two customer records together.
 *
 * Executes the official Avalara AvaTax REST API operation LinkShipToCustomersToBillCustomer.
 */
class AvalaraLinkShipToCustomersToBillCustomer extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_link_ship_to_customers_to_bill_customer';
}