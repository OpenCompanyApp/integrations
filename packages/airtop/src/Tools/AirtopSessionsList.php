<?php

namespace OpenCompany\Integrations\Airtop\Tools;

/**
 * Get a list of sessions.
 *
 * Executes the official Airtop API operation list.
 */
class AirtopSessionsList extends AbstractAirtopOperationTool
{
    protected const OPERATION = 'airtop_sessions_list';
}
