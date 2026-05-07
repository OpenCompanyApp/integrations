<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Delete a tax notice root cause type..
 *
 * Executes the official Avalara AvaTax REST API operation DeleteNoticeRootCauseType.
 */
class AvalaraDeleteNoticeRootCauseType extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_delete_notice_root_cause_type';
}