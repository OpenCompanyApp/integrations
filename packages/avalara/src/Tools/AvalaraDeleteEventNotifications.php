<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Delete company event notifications.
 *
 * Executes the official Avalara AvaTax REST API operation DeleteEventNotifications.
 */
class AvalaraDeleteEventNotifications extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_delete_event_notifications';
}