<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the full list of Avalara-supported tax notice reasons..
 *
 * Executes the official Avalara AvaTax REST API operation ListNoticeReasons.
 */
class AvalaraListNoticeReasons extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_notice_reasons';
}