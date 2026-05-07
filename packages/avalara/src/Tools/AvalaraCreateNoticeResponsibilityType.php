<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Creates a new tax notice responsibility type..
 *
 * Executes the official Avalara AvaTax REST API operation CreateNoticeResponsibilityType.
 */
class AvalaraCreateNoticeResponsibilityType extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_create_notice_responsibility_type';
}