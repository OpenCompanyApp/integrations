<?php

namespace OpenCompany\Integrations\CompaniesHouse\Tools;

/**
 * Retrieve a single company charge.
 */
class CompaniesHouseCharge extends AbstractCompaniesHouseTool
{
    protected const NAME = 'companies_house_charge';
    protected const DESCRIPTION = 'Retrieve one company charge by charge ID.';
    protected const METHOD = 'charge';
    protected const REQUIRED = ['company_number', 'charge_id'];
    protected const PARAMETERS = [
        'company_number' => ['type' => 'string', 'required' => true, 'description' => 'Companies House company number.'],
        'charge_id' => ['type' => 'string', 'required' => true, 'description' => 'Charge identifier.'],
    ];
}
