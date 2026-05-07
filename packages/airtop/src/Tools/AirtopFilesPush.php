<?php

namespace OpenCompany\Integrations\Airtop\Tools;

/**
 * Push a file to a session.
 *
 * Executes the official Airtop API operation push.
 */
class AirtopFilesPush extends AbstractAirtopOperationTool
{
    protected const OPERATION = 'airtop_files_push';
}
