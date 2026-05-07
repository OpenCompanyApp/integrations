<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * Pauses the state of the schema exporter.
 */
class ConfluentPauseExporterByName extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_pause_exporter_by_name';
}
