<?php

namespace OpenCompany\Integrations\CompaniesHouse\Tools;

/**
 * Retrieve a corporate disqualified officer record.
 */
class CompaniesHouseDisqualifiedOfficerCorporate extends AbstractCompaniesHouseTool
{
    protected const NAME = 'companies_house_disqualified_officer_corporate';
    protected const DESCRIPTION = 'Retrieve one corporate disqualified officer record.';
    protected const METHOD = 'disqualifiedOfficerCorporate';
    protected const REQUIRED = ['officer_id'];
    protected const PARAMETERS = [
        'officer_id' => ['type' => 'string', 'required' => true, 'description' => 'Disqualified corporate officer identifier.'],
    ];
}
