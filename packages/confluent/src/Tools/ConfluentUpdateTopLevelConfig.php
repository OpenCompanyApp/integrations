<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * Updates the global compatibility level, compatibility group, schema normalization, default metadata, and rule set. On success, echoes the original request back to the client.
 */
class ConfluentUpdateTopLevelConfig extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_update_top_level_config';
}
