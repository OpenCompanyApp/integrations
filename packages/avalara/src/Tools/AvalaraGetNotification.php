<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve a single notification..
 *
 * Executes the official Avalara AvaTax REST API operation GetNotification.
 */
class AvalaraGetNotification extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_notification';
}