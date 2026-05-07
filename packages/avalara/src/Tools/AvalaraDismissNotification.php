<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Mark a single notification as dismissed..
 *
 * Executes the official Avalara AvaTax REST API operation DismissNotification.
 */
class AvalaraDismissNotification extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_dismiss_notification';
}