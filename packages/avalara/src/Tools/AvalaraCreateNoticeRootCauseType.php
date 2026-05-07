<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Creates a new tax notice root cause type..
 *
 * Executes the official Avalara AvaTax REST API operation CreateNoticeRootCauseType.
 */
class AvalaraCreateNoticeRootCauseType extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_create_notice_root_cause_type';
}