<?php

namespace OpenCompany\Integrations\CompaniesHouse\Tools;

/**
 * Retrieve a corporate entity PSC record.
 */
class CompaniesHousePscCorporateEntity extends AbstractCompaniesHouseTool
{
    protected const NAME = 'companies_house_psc_corporate_entity';
    protected const DESCRIPTION = 'Retrieve one corporate entity person with significant control.';
    protected const METHOD = 'pscCorporateEntity';
    protected const REQUIRED = ['company_number', 'psc_id'];
    protected const PARAMETERS = [
        'company_number' => ['type' => 'string', 'required' => true, 'description' => 'Companies House company number.'],
        'psc_id' => ['type' => 'string', 'required' => true, 'description' => 'PSC identifier from list links.'],
    ];
}
