<?php

namespace OpenCompany\Integrations\CompaniesHouse\Tools;

/**
 * Retrieve a legal person PSC record.
 */
class CompaniesHousePscLegalPerson extends AbstractCompaniesHouseTool
{
    protected const NAME = 'companies_house_psc_legal_person';
    protected const DESCRIPTION = 'Retrieve one legal person with significant control.';
    protected const METHOD = 'pscLegalPerson';
    protected const REQUIRED = ['company_number', 'psc_id'];
    protected const PARAMETERS = [
        'company_number' => ['type' => 'string', 'required' => true, 'description' => 'Companies House company number.'],
        'psc_id' => ['type' => 'string', 'required' => true, 'description' => 'PSC identifier from list links.'],
    ];
}
