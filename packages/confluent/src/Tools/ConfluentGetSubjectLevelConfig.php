<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * Retrieves compatibility level, compatibility group, normalization, default metadata, and rule set for a subject.
 */
class ConfluentGetSubjectLevelConfig extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_get_subject_level_config';
}
