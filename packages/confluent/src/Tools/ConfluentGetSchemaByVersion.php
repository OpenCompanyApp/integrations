<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * Retrieves a specific version of the schema registered under this subject.
 */
class ConfluentGetSchemaByVersion extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_get_schema_by_version';
}
