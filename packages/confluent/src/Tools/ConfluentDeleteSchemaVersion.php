<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * Deletes a specific version of the schema registered under this subject. This only deletes the version and the schema ID remains intact making it still possible to decode data using the schema ID. This API is recommended to be used only in development environments or under extreme circumstances where-in, its required to delete a previously registered schema for compatibility purposes or re-register previously registered schema.
 */
class ConfluentDeleteSchemaVersion extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_delete_schema_version';
}
