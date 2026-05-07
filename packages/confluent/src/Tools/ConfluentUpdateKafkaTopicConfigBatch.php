<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * !Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Update or delete a set of topic configuration parameters. Also supports a dry-run mode that only validates whether the operation would succeed if the validateonly request property is explicitly specified and set to true.
 */
class ConfluentUpdateKafkaTopicConfigBatch extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_update_kafka_topic_config_batch';
}
