<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * Deletes the global compatibility level config and reverts to the default.
 */
class ConfluentDeleteTopLevelConfig extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_delete_top_level_config';
}
