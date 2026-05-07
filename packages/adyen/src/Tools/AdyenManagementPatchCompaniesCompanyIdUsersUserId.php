<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Update user details.
 *
 * Executes the official Adyen management API operation patch-companies-companyId-users-userId.
 */
class AdyenManagementPatchCompaniesCompanyIdUsersUserId extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_patch_companies_company_id_users_user_id';
}
