<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the full list of Avalara-supported tax notice customer types..
 *
 * Executes the official Avalara AvaTax REST API operation ListNoticeCustomerTypes.
 */
class AvalaraListNoticeCustomerTypes extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_notice_customer_types';
}