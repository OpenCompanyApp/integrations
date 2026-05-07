<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * Retrieves the schema for the specified version of this subject. Only the unescaped schema string is returned.
 */
class ConfluentGetSchemaOnly1 extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_get_schema_only_1';
}
