<?php

namespace OpenCompany\Integrations\CompaniesHouse\Tools;

/**
 * Retrieve a super-secure PSC record.
 */
class CompaniesHousePscSuperSecure extends AbstractCompaniesHouseTool
{
    protected const NAME = 'companies_house_psc_super_secure';
    protected const DESCRIPTION = 'Retrieve one super-secure person with significant control.';
    protected const METHOD = 'pscSuperSecure';
    protected const REQUIRED = ['company_number', 'psc_id'];
    protected const PARAMETERS = [
        'company_number' => ['type' => 'string', 'required' => true, 'description' => 'Companies House company number.'],
        'psc_id' => ['type' => 'string', 'required' => true, 'description' => 'PSC identifier from list links.'],
    ];
}
