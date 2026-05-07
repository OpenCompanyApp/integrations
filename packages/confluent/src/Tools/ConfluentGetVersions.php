<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * Get all the subject-version pairs associated with the input ID.
 */
class ConfluentGetVersions extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_get_versions';
}
