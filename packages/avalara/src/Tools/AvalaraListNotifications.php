<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * List all notifications..
 *
 * Executes the official Avalara AvaTax REST API operation ListNotifications.
 */
class AvalaraListNotifications extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_notifications';
}