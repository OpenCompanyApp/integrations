<?php

namespace OpenCompany\Integrations\CompaniesHouse\Tools;

/**
 * Retrieve a single filing history item.
 */
class CompaniesHouseFilingHistoryItem extends AbstractCompaniesHouseTool
{
    protected const NAME = 'companies_house_filing_history_item';
    protected const DESCRIPTION = 'Retrieve one filing history item by transaction ID.';
    protected const METHOD = 'filingHistoryItem';
    protected const REQUIRED = ['company_number', 'transaction_id'];
    protected const PARAMETERS = [
        'company_number' => ['type' => 'string', 'required' => true, 'description' => 'Companies House company number.'],
        'transaction_id' => ['type' => 'string', 'required' => true, 'description' => 'Filing transaction ID.'],
    ];
}
