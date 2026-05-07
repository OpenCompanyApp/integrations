<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Delete a tax notice responsibility type..
 *
 * Executes the official Avalara AvaTax REST API operation DeleteNoticeResponsibilityType.
 */
class AvalaraDeleteNoticeResponsibilityType extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_delete_notice_responsibility_type';
}