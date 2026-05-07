<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * Deletes the specified subject-level compatibility level config and reverts to the global default.
 */
class ConfluentDeleteSubjectConfig extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_delete_subject_config';
}
