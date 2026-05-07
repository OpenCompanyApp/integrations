<?php

namespace OpenCompany\Integrations\Airtop\Tools;

/**
 * Ends a session.
 *
 * Executes the official Airtop API operation terminate.
 */
class AirtopSessionsTerminate extends AbstractAirtopOperationTool
{
    protected const OPERATION = 'airtop_sessions_terminate';
}
