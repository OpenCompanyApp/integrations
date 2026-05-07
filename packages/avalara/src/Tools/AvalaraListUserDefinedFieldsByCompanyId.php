<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * List User Defined Fields By Company Id.
 *
 * Executes the official Avalara AvaTax REST API operation ListUserDefinedFieldsByCompanyId.
 */
class AvalaraListUserDefinedFieldsByCompanyId extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_user_defined_fields_by_company_id';
}