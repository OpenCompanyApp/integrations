<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * !General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to delete a user. If successful, this request will also recursively delete all of the user's associated resources, including its cloud and cluster API keys.
 */
class ConfluentDeleteIAMV2User extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_delete_iam_v2_user';
}
