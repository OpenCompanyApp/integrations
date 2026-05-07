<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * !Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Create a topic. Also supports a dry-run mode that only validates whether the topic creation would succeed if the validateonly request property is explicitly specified and set to true. Note that when dry-run mode is being used the response status would be 200 OK instead of 201 Created.
 */
class ConfluentCreateTopic extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_create_topic';
}
