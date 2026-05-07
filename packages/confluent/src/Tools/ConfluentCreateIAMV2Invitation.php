<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * !General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to create an invitation. The newly invited user will not have any permissions. Give the user permission by assigning them to one or more roles by creating role bindingshttps://docs.confluent.io/cloud/current/api.htmltag/Role-Bindings-iamv2 for the created user.
 */
class ConfluentCreateIAMV2Invitation extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_create_iam_v2_invitation';
}
