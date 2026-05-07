<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the full list of Avalara-supported tax notice responsibility ids.
 *
 * Executes the official Avalara AvaTax REST API operation ListNoticeResponsibilities.
 */
class AvalaraListNoticeResponsibilities extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_notice_responsibilities';
}