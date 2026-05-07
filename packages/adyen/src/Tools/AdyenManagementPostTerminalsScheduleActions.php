<?php

namespace OpenCompany\Integrations\Adyen\Tools;

/**
 * Create a terminal action.
 *
 * Executes the official Adyen management API operation post-terminals-scheduleActions.
 */
class AdyenManagementPostTerminalsScheduleActions extends AbstractAdyenOperationTool
{
    protected const OPERATION = 'adyen_management_post_terminals_schedule_actions';
}
