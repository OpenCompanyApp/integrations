<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Retrieve company event notifications..
 *
 * Executes the official Avalara AvaTax REST API operation GetEventNotifications.
 */
class AvalaraGetEventNotifications extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_get_event_notifications';
}