<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * Retrieves the global compatibility level, compatibility group, normalization, default metadata, and rule set.
 */
class ConfluentGetTopLevelConfig extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_get_top_level_config';
}
