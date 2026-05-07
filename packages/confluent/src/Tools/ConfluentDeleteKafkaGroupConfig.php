<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * !Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Delete the dynamic configuration override with the specified name for the specified group. After deletion, the default group configuration will be applied. This API supports consumer groups, share groups, and streams groups.
 */
class ConfluentDeleteKafkaGroupConfig extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_delete_kafka_group_config';
}
