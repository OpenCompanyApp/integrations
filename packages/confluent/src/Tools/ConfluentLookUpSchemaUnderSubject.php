<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * Check if a schema has already been registered under the specified subject. If so, this returns the schema string along with its globally unique identifier, its version under this subject and the subject name.
 */
class ConfluentLookUpSchemaUnderSubject extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_look_up_schema_under_subject';
}
