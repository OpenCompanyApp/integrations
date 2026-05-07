<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * Creates a new schema exporter. All attributes in request body are optional except config.
 */
class ConfluentRegisterExporter extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_register_exporter';
}
