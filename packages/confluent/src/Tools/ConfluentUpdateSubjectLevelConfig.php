<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * Update compatibility level, compatibility group, normalization, default metadata, and rule set for the specified subject. On success, echoes the original request back to the client.
 */
class ConfluentUpdateSubjectLevelConfig extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_update_subject_level_config';
}
