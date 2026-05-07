<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Create new notifications..
 *
 * Executes the official Avalara AvaTax REST API operation CreateNotifications.
 */
class AvalaraCreateNotifications extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_create_notifications';
}