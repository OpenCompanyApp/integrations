<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * !General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Resume a paused connector or do nothing if the connector is not paused. This call is asynchronous and the tasks will not transition to RUNNING state at the same time.
 */
class ConfluentResumeConnectv1Connector extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_resume_connectv1_connector';
}
