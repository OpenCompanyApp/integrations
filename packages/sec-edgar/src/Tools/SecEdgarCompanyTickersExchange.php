<?php

namespace OpenCompany\Integrations\SecEdgar\Tools;

/**
 * Retrieve SEC company ticker and exchange mappings.
 */
class SecEdgarCompanyTickersExchange extends AbstractSecEdgarTool
{
    protected const NAME = 'sec_edgar_company_tickers_exchange';
    protected const DESCRIPTION = 'Retrieve SEC CIK, ticker, exchange, and company title mappings.';
    protected const METHOD = 'companyTickersExchange';
}
