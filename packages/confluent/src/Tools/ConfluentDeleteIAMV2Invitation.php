<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * !General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to delete an invitation. Delete will deactivate the user if the user didn't accept the invitation yet.
 */
class ConfluentDeleteIAMV2Invitation extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_delete_iam_v2_invitation';
}
