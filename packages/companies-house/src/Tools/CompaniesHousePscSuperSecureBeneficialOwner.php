<?php

namespace OpenCompany\Integrations\CompaniesHouse\Tools;

/**
 * Retrieve a super-secure beneficial owner PSC record.
 */
class CompaniesHousePscSuperSecureBeneficialOwner extends AbstractCompaniesHouseTool
{
    protected const NAME = 'companies_house_psc_super_secure_beneficial_owner';
    protected const DESCRIPTION = 'Retrieve one super-secure beneficial owner person with significant control.';
    protected const METHOD = 'pscSuperSecureBeneficialOwner';
    protected const REQUIRED = ['company_number', 'psc_id'];
    protected const PARAMETERS = [
        'company_number' => ['type' => 'string', 'required' => true, 'description' => 'Companies House company number.'],
        'psc_id' => ['type' => 'string', 'required' => true, 'description' => 'PSC identifier from list links.'],
    ];
}
