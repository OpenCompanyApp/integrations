<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * !Generally Availablehttps://img.shields.io/badge/Lifecycle%20Stage-Generally%20Available-%2345c6e8section/Versioning/API-Lifecycle-Policy - When calling /acls without the principal parameter, service accounts are returned in numeric ID format e.g., User:12345. - To retrieve service accounts in the sa-xxx format, use /acls?principal=UserV2:. - The principal parameter supports both legacy User: format and new UserV2: format for service accounts. Return a list of ACLs that match the search criteria.
 */
class ConfluentGetKafkaAcls extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_get_kafka_acls';
}
