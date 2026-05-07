<?php

namespace OpenCompany\Integrations\CompaniesHouse\Tools;

/**
 * Retrieve an individual PSC record.
 */
class CompaniesHousePscIndividual extends AbstractCompaniesHouseTool
{
    protected const NAME = 'companies_house_psc_individual';
    protected const DESCRIPTION = 'Retrieve one individual person with significant control.';
    protected const METHOD = 'pscIndividual';
    protected const REQUIRED = ['company_number', 'psc_id'];
    protected const PARAMETERS = [
        'company_number' => ['type' => 'string', 'required' => true, 'description' => 'Companies House company number.'],
        'psc_id' => ['type' => 'string', 'required' => true, 'description' => 'PSC identifier from list links.'],
    ];
}
