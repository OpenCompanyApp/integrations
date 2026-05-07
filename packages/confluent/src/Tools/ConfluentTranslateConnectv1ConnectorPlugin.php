<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * !General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Translate the provided Self Managed configuration values. This API performs configuration translation and returns the translated fully managed configuration along with any errors or warnings. Query Parameter masksensitive=true redacts sensitive config values in response.
 */
class ConfluentTranslateConnectv1ConnectorPlugin extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_translate_connectv1_connector_plugin';
}
