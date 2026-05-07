<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve all customers and suppliers with their country parameters for a company.
 *
 * Executes the official Avalara AvaTax REST API operation GetAllCustomersAndSuppliersWithCountryParams.
 */
class AvalaraGetAllCustomersAndSuppliersWithCountryParams extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_all_customers_and_suppliers_with_country_params';
}