<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve the full list of Avalara-supported tax notice root causes.
 *
 * Executes the official Avalara AvaTax REST API operation ListNoticeRootCauses.
 */
class AvalaraListNoticeRootCauses extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_notice_root_causes';
}