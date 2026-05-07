<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the parameters by companyId and itemId..
 *
 * Executes the official Avalara AvaTax REST API operation ListRecommendedParameterByCompanyIdAndItemId.
 */
class AvalaraListRecommendedParameterByCompanyIdAndItemId extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_recommended_parameter_by_company_id_and_item_id';
}