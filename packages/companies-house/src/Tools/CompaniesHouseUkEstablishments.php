<?php

namespace OpenCompany\Integrations\CompaniesHouse\Tools;

/**
 * List UK establishments for an overseas company.
 */
class CompaniesHouseUkEstablishments extends AbstractCompaniesHouseTool
{
    protected const NAME = 'companies_house_uk_establishments';
    protected const DESCRIPTION = 'List UK establishments for an overseas company.';
    protected const METHOD = 'ukEstablishments';
    protected const REQUIRED = ['company_number'];
    protected const PARAMETERS = [
        'company_number' => ['type' => 'string', 'required' => true, 'description' => 'Companies House overseas company number.'],
    ];
}
