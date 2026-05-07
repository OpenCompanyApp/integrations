<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * Update global mode. On success, echoes the original request back to the client.
 */
class ConfluentUpdateTopLevelMode extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_update_top_level_mode';
}
