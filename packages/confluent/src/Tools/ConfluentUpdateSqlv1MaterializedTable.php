<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * !General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to update a Materialized Table's mutable fields. Mutable fields include: query, stopped, computepoolid, principal, columns, watermark, constraints and tableoptions.
 */
class ConfluentUpdateSqlv1MaterializedTable extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_update_sqlv1_materialized_table';
}
