<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Delete a single notification..
 *
 * Executes the official Avalara AvaTax REST API operation DeleteNotification.
 */
class AvalaraDeleteNotification extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_delete_notification';
}