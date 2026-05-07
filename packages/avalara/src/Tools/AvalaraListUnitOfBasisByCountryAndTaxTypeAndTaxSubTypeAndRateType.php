<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the list of applicable UnitOfBasis.
 *
 * Executes the official Avalara AvaTax REST API operation ListUnitOfBasisByCountryAndTaxTypeAndTaxSubTypeAndRateType.
 */
class AvalaraListUnitOfBasisByCountryAndTaxTypeAndTaxSubTypeAndRateType extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_unit_of_basis_by_country_and_tax_type_and_tax_sub_type_and_rate_type';
}