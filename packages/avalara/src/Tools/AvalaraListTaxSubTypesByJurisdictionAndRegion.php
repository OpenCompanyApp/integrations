<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the full list of tax sub types by jurisdiction code and region.
 *
 * Executes the official Avalara AvaTax REST API operation ListTaxSubTypesByJurisdictionAndRegion.
 */
class AvalaraListTaxSubTypesByJurisdictionAndRegion extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_tax_sub_types_by_jurisdiction_and_region';
}