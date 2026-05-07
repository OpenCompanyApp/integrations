<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * !Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Increase the number of partitions for a topic. To update other topic configurations, see https://docs.confluent.io/cloud/current/api.htmltag/Configs-v3/operation/updateKafkaTopicConfig.
 */
class ConfluentUpdatePartitionCountKafkaTopic extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_update_partition_count_kafka_topic';
}
