<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Create a shipping location.
 *
 * Executes the official Adyen management API operation post-companies-companyId-shippingLocations.
 */
class AdyenManagementPostCompaniesCompanyIdShippingLocations extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_post_companies_company_id_shipping_locations';
}
