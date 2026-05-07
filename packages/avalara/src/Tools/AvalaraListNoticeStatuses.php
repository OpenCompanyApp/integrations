<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the full list of Avalara-supported tax notice statuses..
 *
 * Executes the official Avalara AvaTax REST API operation ListNoticeStatuses.
 */
class AvalaraListNoticeStatuses extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_notice_statuses';
}