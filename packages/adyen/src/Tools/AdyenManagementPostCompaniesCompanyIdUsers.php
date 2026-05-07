<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Create a new user.
 *
 * Executes the official Adyen management API operation post-companies-companyId-users.
 */
class AdyenManagementPostCompaniesCompanyIdUsers extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_post_companies_company_id_users';
}
