<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Get user details.
 *
 * Executes the official Adyen management API operation get-companies-companyId-users-userId.
 */
class AdyenManagementGetCompaniesCompanyIdUsersUserId extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_get_companies_company_id_users_user_id';
}
