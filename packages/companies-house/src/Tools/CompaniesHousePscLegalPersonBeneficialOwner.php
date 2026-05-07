<?php

namespace OpenCompany\Integrations\CompaniesHouse\Tools;

/**
 * Retrieve a legal person beneficial owner PSC record.
 */
class CompaniesHousePscLegalPersonBeneficialOwner extends AbstractCompaniesHouseTool
{
    protected const NAME = 'companies_house_psc_legal_person_beneficial_owner';
    protected const DESCRIPTION = 'Retrieve one legal person beneficial owner person with significant control.';
    protected const METHOD = 'pscLegalPersonBeneficialOwner';
    protected const REQUIRED = ['company_number', 'psc_id'];
    protected const PARAMETERS = [
        'company_number' => ['type' => 'string', 'required' => true, 'description' => 'Companies House company number.'],
        'psc_id' => ['type' => 'string', 'required' => true, 'description' => 'PSC identifier from list links.'],
    ];
}
