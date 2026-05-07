<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * Update mode for the specified subject. On success, echoes the original request back to the client.
 */
class ConfluentUpdateMode extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_update_mode';
}
