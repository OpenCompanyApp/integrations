<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * Updates the information or configurations of the schema exporter. All attributes in request body are optional.
 */
class ConfluentUpdateExporterInfo extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_update_exporter_info';
}
