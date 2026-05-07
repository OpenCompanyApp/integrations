<?php

namespace OpenCompany\Integrations\CompaniesHouse\Tools;

/**
 * Retrieve an individual beneficial owner PSC record.
 */
class CompaniesHousePscIndividualBeneficialOwner extends AbstractCompaniesHouseTool
{
    protected const NAME = 'companies_house_psc_individual_beneficial_owner';
    protected const DESCRIPTION = 'Retrieve one individual beneficial owner person with significant control.';
    protected const METHOD = 'pscIndividualBeneficialOwner';
    protected const REQUIRED = ['company_number', 'psc_id'];
    protected const PARAMETERS = [
        'company_number' => ['type' => 'string', 'required' => true, 'description' => 'Companies House company number.'],
        'psc_id' => ['type' => 'string', 'required' => true, 'description' => 'PSC identifier from list links.'],
    ];
}
