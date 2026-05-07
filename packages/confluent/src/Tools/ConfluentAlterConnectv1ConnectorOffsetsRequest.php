<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * !General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Request to alter the offsets of a connector. This supports the ability to PATCH/DELETE the offsets of a connector. Note, you will see momentary downtime as this will internally stop the connector, while the offsets are being altered. You can only make one alter offsets request at a time for a connector.
 */
class ConfluentAlterConnectv1ConnectorOffsetsRequest extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_alter_connectv1_connector_offsets_request';
}
