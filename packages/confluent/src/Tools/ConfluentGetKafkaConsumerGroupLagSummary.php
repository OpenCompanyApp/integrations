<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * !Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy !Available in dedicated clusters onlyhttps://img.shields.io/badge/-Available%20in%20dedicated%20clusters%20only-%23bc8540https://docs.confluent.io/cloud/current/clusters/cluster-types.htmldedicated-cluster Return the maximum and total lag of the consumers belonging to the specified consumer group.
 */
class ConfluentGetKafkaConsumerGroupLagSummary extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_get_kafka_consumer_group_lag_summary';
}
