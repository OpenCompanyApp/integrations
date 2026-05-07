<?php

namespace OpenCompany\Integrations\CompaniesHouse\Tools;

/**
 * Retrieve a corporate entity beneficial owner PSC record.
 */
class CompaniesHousePscCorporateEntityBeneficialOwner extends AbstractCompaniesHouseTool
{
    protected const NAME = 'companies_house_psc_corporate_entity_beneficial_owner';
    protected const DESCRIPTION = 'Retrieve one corporate entity beneficial owner person with significant control.';
    protected const METHOD = 'pscCorporateEntityBeneficialOwner';
    protected const REQUIRED = ['company_number', 'psc_id'];
    protected const PARAMETERS = [
        'company_number' => ['type' => 'string', 'required' => true, 'description' => 'Companies House company number.'],
        'psc_id' => ['type' => 'string', 'required' => true, 'description' => 'PSC identifier from list links.'],
    ];
}
