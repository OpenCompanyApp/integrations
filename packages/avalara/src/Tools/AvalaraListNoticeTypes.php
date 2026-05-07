<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the full list of Avalara-supported tax notice types..
 *
 * Executes the official Avalara AvaTax REST API operation ListNoticeTypes.
 */
class AvalaraListNoticeTypes extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_notice_types';
}