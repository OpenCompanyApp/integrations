<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the full list of Avalara-supported tax notice priorities..
 *
 * Executes the official Avalara AvaTax REST API operation ListNoticePriorities.
 */
class AvalaraListNoticePriorities extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_notice_priorities';
}