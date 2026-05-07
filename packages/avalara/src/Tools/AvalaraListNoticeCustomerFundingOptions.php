<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the full list of Avalara-supported tax notice customer funding options..
 *
 * Executes the official Avalara AvaTax REST API operation ListNoticeCustomerFundingOptions.
 */
class AvalaraListNoticeCustomerFundingOptions extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_notice_customer_funding_options';
}