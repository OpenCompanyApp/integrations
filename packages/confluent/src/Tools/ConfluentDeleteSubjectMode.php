<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * Deletes the specified subject-level mode and reverts to the global default.
 */
class ConfluentDeleteSubjectMode extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_delete_subject_mode';
}
