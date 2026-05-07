<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * Retrieves a list of versions registered under the specified subject.
 */
class ConfluentListVersions extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_list_versions';
}
