<?php

namespace OpenCompany\Integrations\SecEdgar\Tools;

/**
 * Retrieve SEC company ticker mappings.
 */
class SecEdgarCompanyTickers extends AbstractSecEdgarTool
{
    protected const NAME = 'sec_edgar_company_tickers';
    protected const DESCRIPTION = 'Retrieve SEC CIK, ticker, and company title mappings.';
    protected const METHOD = 'companyTickers';
}
