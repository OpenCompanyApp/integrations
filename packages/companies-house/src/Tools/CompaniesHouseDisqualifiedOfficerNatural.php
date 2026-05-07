<?php

namespace OpenCompany\Integrations\CompaniesHouse\Tools;

/**
 * Retrieve a natural disqualified officer record.
 */
class CompaniesHouseDisqualifiedOfficerNatural extends AbstractCompaniesHouseTool
{
    protected const NAME = 'companies_house_disqualified_officer_natural';
    protected const DESCRIPTION = 'Retrieve one natural disqualified officer record.';
    protected const METHOD = 'disqualifiedOfficerNatural';
    protected const REQUIRED = ['officer_id'];
    protected const PARAMETERS = [
        'officer_id' => ['type' => 'string', 'required' => true, 'description' => 'Disqualified officer identifier.'],
    ];
}
