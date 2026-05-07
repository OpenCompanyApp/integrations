<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * List jurisdictions based on the provided taxTypeId, taxSubTypeId, country, and rateTypeId.
 *
 * Executes the official Avalara AvaTax REST API operation ListJurisdictionsByRateTypeTaxTypeMapping.
 */
class AvalaraListJurisdictionsByRateTypeTaxTypeMapping extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_jurisdictions_by_rate_type_tax_type_mapping';
}