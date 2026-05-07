<?php

namespace OpenCompany\Integrations\SecEdgar\Tools;

/**
 * Retrieve one standardized XBRL taxonomy concept for a filer.
 */
class SecEdgarCompanyConcept extends AbstractSecEdgarTool
{
    protected const NAME = 'sec_edgar_company_concept';
    protected const DESCRIPTION = 'Retrieve all disclosures for one company, taxonomy, and XBRL tag.';
    protected const METHOD = 'companyConcept';
    protected const REQUIRED = ['cik', 'taxonomy', 'tag'];
    protected const PARAMETERS = [
        'cik' => ['type' => ['string', 'integer'], 'required' => true, 'description' => 'Central Index Key. Leading zeros are optional.'],
        'taxonomy' => ['type' => 'string', 'required' => true, 'description' => 'Taxonomy such as us-gaap, ifrs-full, dei, or srt.'],
        'tag' => ['type' => 'string', 'required' => true, 'description' => 'XBRL tag such as AccountsPayableCurrent.'],
    ];
}
