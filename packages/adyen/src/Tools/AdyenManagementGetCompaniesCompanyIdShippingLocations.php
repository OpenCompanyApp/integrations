<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get a list of shipping locations.
 *
 * Executes the official Adyen management API operation get-companies-companyId-shippingLocations.
 */
class AdyenManagementGetCompaniesCompanyIdShippingLocations extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_companies_company_id_shipping_locations';
}
