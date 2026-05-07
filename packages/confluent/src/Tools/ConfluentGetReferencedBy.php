<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * Retrieves the IDs of schemas that reference the specified schema.
 */
class ConfluentGetReferencedBy extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_get_referenced_by';
}
