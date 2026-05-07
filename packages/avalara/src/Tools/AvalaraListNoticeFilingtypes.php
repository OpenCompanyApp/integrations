<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the full list of Avalara-supported tax notice filing types..
 *
 * Executes the official Avalara AvaTax REST API operation ListNoticeFilingtypes.
 */
class AvalaraListNoticeFilingtypes extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_notice_filingtypes';
}