<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * !Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Return a list of dynamic cluster-wide broker configuration parameters for the specified Kafka cluster. Returns an empty list if there are no dynamic cluster-wide broker configuration parameters.
 */
class ConfluentListKafkaClusterConfigs extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_list_kafka_cluster_configs';
}
