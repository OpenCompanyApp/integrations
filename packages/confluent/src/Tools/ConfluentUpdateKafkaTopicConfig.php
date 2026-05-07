<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * !Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Update the configuration parameter with given name. To update the number of partitions, see https://docs.confluent.io/cloud/current/api.htmltag/Topic-v3/operation/updatePartitionCountKafkaTopic.
 */
class ConfluentUpdateKafkaTopicConfig extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_update_kafka_topic_config';
}
