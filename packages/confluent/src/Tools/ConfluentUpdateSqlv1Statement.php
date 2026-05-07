<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * !General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Make a request to update a statement. The request will fail with a 409 Conflict error if the Statement has changed since it was fetched. In this case, do a GET, reapply the modifications, and try the update again.
 */
class ConfluentUpdateSqlv1Statement extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_update_sqlv1_statement';
}
