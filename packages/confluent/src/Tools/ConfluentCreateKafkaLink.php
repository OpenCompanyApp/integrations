<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * !Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy Cluster link creation requires source cluster security configurations in the configs JSON section of the data request payload.
 */
class ConfluentCreateKafkaLink extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_create_kafka_link';
}
