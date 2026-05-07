<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get a list of billing entities.
 *
 * Executes the official Adyen management API operation get-companies-companyId-billingEntities.
 */
class AdyenManagementGetCompaniesCompanyIdBillingEntities extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_companies_company_id_billing_entities';
}
