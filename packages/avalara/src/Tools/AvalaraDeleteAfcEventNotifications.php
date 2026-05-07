<?php

namespace OpenCompany\Integrations\Avalara\Tools;

/**
 * Delete AFC event notifications..
 *
 * Executes the official Avalara AvaTax REST API operation DeleteAfcEventNotifications.
 */
class AvalaraDeleteAfcEventNotifications extends AbstractAvalaraOperationTool
{
    protected const OPERATION = 'avalara_delete_afc_event_notifications';
}