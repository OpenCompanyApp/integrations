<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * List jurisdiction types based on the provided taxTypeId, taxSubTypeId, country, and rateTypeId.
 *
 * Executes the official Avalara AvaTax REST API operation ListJurisdictionTypesByRateTypeTaxTypeMapping.
 */
class AvalaraListJurisdictionTypesByRateTypeTaxTypeMapping extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_jurisdiction_types_by_rate_type_tax_type_mapping';
}