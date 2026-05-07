<?php

namespace OpenCompany\Integrations\SecEdgar\Tools;

/**
 * Retrieve all standardized XBRL company facts for a filer.
 */
class SecEdgarCompanyFacts extends SecEdgarSubmissions
{
    protected const NAME = 'sec_edgar_company_facts';
    protected const DESCRIPTION = 'Retrieve all standardized XBRL facts for a company by CIK.';
    protected const METHOD = 'companyFacts';
}
