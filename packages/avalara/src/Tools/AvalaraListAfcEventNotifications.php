<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve AFC event notifications.
 *
 * Executes the official Avalara AvaTax REST API operation ListAfcEventNotifications.
 */
class AvalaraListAfcEventNotifications extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_list_afc_event_notifications';
}