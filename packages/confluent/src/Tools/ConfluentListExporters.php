<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * Retrieves a list of schema exporters that have been created.
 */
class ConfluentListExporters extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_list_exporters';
}
