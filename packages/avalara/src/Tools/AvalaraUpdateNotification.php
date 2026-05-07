<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Update a single notification..
 *
 * Executes the official Avalara AvaTax REST API operation UpdateNotification.
 */
class AvalaraUpdateNotification extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_update_notification';
}